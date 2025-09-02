#!/bin/bash
set -e

# Function untuk logging dengan timestamp
log() {
    echo "[$(date +'%Y-%m-%d %H:%M:%S')] $1"
}

# Function untuk menjalankan artisan command dengan error handling
run_artisan() {
    local cmd="$1"
    local description="$2"
    local allow_failure="${3:-false}"
    
    log "Menjalankan: $description"
    if php artisan $cmd; then
        log "✓ Berhasil: $description"
        return 0
    else
        local exit_code=$?
        log "✗ Gagal: $description (exit code: $exit_code)"
        if [[ "$allow_failure" != "true" ]]; then
            log "FATAL: Proses dihentikan karena error pada: $description"
            exit $exit_code
        fi
        return $exit_code
    fi
}

log "=== Memulai Docker Entrypoint ==="
cd /var/www/html

# Direktori & permission
log "Menyiapkan direktori dan permission..."
mkdir -p storage/app/livewire-tmp
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/media-library/temp
mkdir -p storage/app/public/media
mkdir -p bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Bersihkan config & views lebih awal agar artisan baca env runtime (tidak menyentuh DB)
run_artisan "config:clear" "Membersihkan config cache" true
run_artisan "view:clear" "Membersihkan view cache" true

# Jangan buat atau tulis file .env di container
# Jika APP_KEY tidak tersedia, generate sementara untuk proses ini saja (tanpa menulis file)
if [ -z "${APP_KEY:-}" ]; then
  log "APP_KEY tidak ter-set, generate sementara untuk runtime..."
  export APP_KEY=$(php artisan key:generate --show)
  log "APP_KEY berhasil di-generate"
fi

# Default agar tidak menyentuh DB saat cache:clear jika user belum set
export CACHE_DRIVER=${CACHE_DRIVER:-file}
log "Cache driver: $CACHE_DRIVER"

# Auto-map env dari Koyeb PostgreSQL Add-on jika DB_* belum diset
log "Konfigurasi database..."
export DB_CONNECTION=${DB_CONNECTION:-pgsql}
export DB_HOST=${DB_HOST:-${POSTGRESQL_HOST:-}}
export DB_PORT=${DB_PORT:-${POSTGRESQL_PORT:-5432}}
export DB_DATABASE=${DB_DATABASE:-${POSTGRESQL_DATABASE:-}}
export DB_USERNAME=${DB_USERNAME:-${POSTGRESQL_USER:-}}
export DB_PASSWORD=${DB_PASSWORD:-${POSTGRESQL_PASSWORD:-}}
export DB_SSLMODE=${DB_SSLMODE:-${POSTGRESQL_SSLMODE:-prefer}}

log "DB_CONNECTION: $DB_CONNECTION"
log "DB_HOST: $DB_HOST"
log "DB_PORT: $DB_PORT" 
log "DB_DATABASE: $DB_DATABASE"
log "DB_USERNAME: $DB_USERNAME"
log "DB_PASSWORD: [${#DB_PASSWORD} karakter]"

# Jika ada POSTGRESQL_URL / DATABASE_URL, parse ke DB_*
URL_TO_PARSE="${POSTGRESQL_URL:-${DATABASE_URL:-}}"
if [ -n "$URL_TO_PARSE" ]; then
  log "Parsing DATABASE_URL: ${URL_TO_PARSE%\?*}..." # Log tanpa query string untuk keamanan
  
  # Format yang umum: postgres://user:pass@host:port/dbname?sslmode=require
  # Hapus protocol
  proto_removed=${URL_TO_PARSE#*://}
  
  # Pisahkan user:pass dari host:port/db
  if [[ "$proto_removed" == *"@"* ]]; then
    userpass=${proto_removed%%@*}
    hostpath=${proto_removed#*@}
  else
    userpass=""
    hostpath=$proto_removed
  fi
  
  # Pisahkan host:port dari /dbname?query
  hostport=${hostpath%%/*}
  dbname_qs=${hostpath#*/}
  
  # Pisahkan dbname dari query string
  dbname=${dbname_qs%%\?*}
  
  # Parse host dan port
  host=${hostport%%:*}
  port=${hostport#*:}
  [ "$host" = "$hostport" ] && port="5432"
  
  # Parse username dan password
  if [ -n "$userpass" ]; then
    dbuser=${userpass%%:*}
    dbpass=${userpass#*:}
  fi
  
  # Set environment variables hanya jika belum ada
  export DB_HOST=${DB_HOST:-$host}
  export DB_PORT=${DB_PORT:-$port}
  export DB_DATABASE=${DB_DATABASE:-$dbname}
  [ -n "$dbuser" ] && export DB_USERNAME=${DB_USERNAME:-$dbuser}
  [ -n "$dbpass" ] && export DB_PASSWORD=${DB_PASSWORD:-$dbpass}
  
  # Extract endpoint ID for Koyeb/Neon PostgreSQL
  if [[ "$host" == *".pg.koyeb.app" ]]; then
    endpoint_id=${host%%-*}
    export DB_OPTIONS=${DB_OPTIONS:-"endpoint=$endpoint_id"}
    log "Auto-detected Koyeb endpoint: $endpoint_id"
  fi
  
  log "Parsed - Host: $DB_HOST, Port: $DB_PORT, Database: $DB_DATABASE, User: $DB_USERNAME"
else
  log "Tidak ada DATABASE_URL untuk di-parse, menggunakan konfigurasi DB_* langsung"
fi

# Pastikan storage link (idempotent)
run_artisan "storage:link" "Membuat symbolic link storage" true

# Jika koneksi pgsql dan DB_HOST tersedia, tunggu DB siap
if [ "${DB_CONNECTION}" = "pgsql" ] && [ -n "${DB_HOST}" ]; then
  log "Menunggu PostgreSQL siap di ${DB_HOST}:${DB_PORT}..."
  MAX_ATTEMPTS=30
  attempt=0
  until php -r 'try {
      $dsn = sprintf("pgsql:host=%s;port=%s;dbname=%s;sslmode=%s", getenv("DB_HOST")?: "localhost", getenv("DB_PORT")?: "5432", getenv("DB_DATABASE")?: "", getenv("DB_SSLMODE")?: "prefer");
      if (getenv("DB_OPTIONS")) {
          $dsn .= ";options=\"" . getenv("DB_OPTIONS") . "\"";
      }
      new PDO($dsn, getenv("DB_USERNAME")?: "", getenv("DB_PASSWORD")?: "");
      exit(0);
  } catch (Throwable $e) { 
      echo "DB Connection Error: " . $e->getMessage();
      exit(1); 
  }'; do
    attempt=$((attempt + 1))
    if [ $attempt -ge $MAX_ATTEMPTS ]; then
        log "FATAL: Database tidak dapat terhubung setelah $MAX_ATTEMPTS percobaan"
        exit 1
    fi
    log "Percobaan $attempt/$MAX_ATTEMPTS - Database belum siap, tunggu 2 detik..."
    sleep 2
  done
  log "✓ PostgreSQL siap dan terhubung"
else
  log "PERINGATAN: DB_HOST tidak ter-set atau DB_CONNECTION bukan pgsql. Lewati penantian DB."
fi

# Test koneksi database dengan artisan (tanpa menjalankan migrasi)
log "Testing koneksi database dengan artisan..."
if run_artisan "migrate:status" "Test koneksi database" true; then
    log "✓ Koneksi database berhasil"
else
    log "PERINGATAN: Koneksi database melalui artisan gagal"
fi

# Discover package (tidak melakukan migrasi)
run_artisan "package:discover --ansi" "Package discovery" true

# INFO: Database Migration dan Seeding telah dipindahkan ke proses manual
log "INFO: Database migration dan seeding tidak dilakukan secara otomatis."
log "INFO: Jalankan 'php artisan migrate' dan 'php artisan db:seed' secara manual dari terminal lokal."

# Final cache clearing dan optimization
log "=== Final Cache & Optimization ==="
run_artisan "cache:clear" "Membersihkan application cache" true

# Optional: Pre-cache untuk production (uncomment jika diperlukan)
if [ "${APP_ENV:-}" = "production" ]; then
    log "Mode production - melakukan cache optimization..."
    run_artisan "config:cache" "Config caching" true
    run_artisan "route:cache" "Route caching" true
    run_artisan "view:cache" "View caching" true
else
    log "Mode development - skip caching optimization"
fi

log "=== Docker Entrypoint Selesai ==="
log "Container siap menerima requests"

# Jalankan CMD (apache2-foreground)
exec "$@"
