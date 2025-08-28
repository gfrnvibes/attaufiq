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
  # Format yang umum: postgres://user:pass@host:port/dbname?sslmode=require
  proto_removed=${URL_TO_PARSE#*://}
  if [[ "$URL_TO_PARSE" == *"@"* ]]; then
    userpass=${proto_removed%%@*}
    hostpath=${proto_removed#*@}
  else
    userpass=""
    hostpath=$proto_removed
  fi
  hostport=${hostpath%%/*}
  dbname_qs=${hostpath#*/}
  dbname=${dbname_qs%%\?*}
  host=${hostport%%:*}
  port=${hostport#*:}
  [ "$host" = "$hostport" ] && port="5432"

  if [ -n "$userpass" ]; then
    dbuser=${userpass%%:*}
    dbpass=${userpass#*:}
  fi

  export DB_HOST=${DB_HOST:-$host}
  export DB_PORT=${DB_PORT:-$port}
  export DB_DATABASE=${DB_DATABASE:-$dbname}
  [ -n "$dbuser" ] && export DB_USERNAME=${DB_USERNAME:-$dbuser}
  [ -n "$dbpass" ] && export DB_PASSWORD=${DB_PASSWORD:-$dbpass}
fi

# Pastikan storage link (idempotent)
run_artisan "storage:link" "Membuat symbolic link storage" true

# Jika koneksi pgsql dan DB_HOST tersedia, tunggu DB siap
if [ "${DB_CONNECTION}" = "pgsql" ] && [ -n "${DB_HOST}" ]; then
  log "Menunggu PostgreSQL siap di ${DB_HOST}:${DB_PORT}..."
  MAX_ATTEMPTS=30
  attempt=0
  until php -r 'try {
      $dsn = sprintf("pgsql:host=%s;port=%s;dbname=%s", getenv("DB_HOST")?: "localhost", getenv("DB_PORT")?: "5432", getenv("DB_DATABASE")?: "");
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

# Test koneksi database dengan artisan
log "Testing koneksi database dengan artisan..."
if run_artisan "migrate:status" "Test koneksi database" true; then
    log "✓ Koneksi database berhasil"
else
    log "PERINGATAN: Koneksi database melalui artisan gagal"
fi

# Discover package dan migrasi (akan berhasil jika DB terkonfigurasi benar)
run_artisan "package:discover --ansi" "Package discovery" true

# Function untuk mengecek user count dengan robust error handling
get_user_count() {
    local count
    count=$(php -r "
        try {
            require 'vendor/autoload.php';
            \$app = require 'bootstrap/app.php';
            \$kernel = \$app->make('Illuminate\\Contracts\\Console\\Kernel');
            \$kernel->bootstrap();
            echo \App\\Models\\User::count();
        } catch (Exception \$e) {
            echo 'ERROR: ' . \$e->getMessage();
        } catch (Throwable \$e) {
            echo 'ERROR: ' . \$e->getMessage();
        }
    " 2>&1)
    
    if [[ "$count" == ERROR:* ]]; then
        log "Error saat mengecek user count: $count"
        echo "0"
    else
        echo "$count"
    fi
}

# Database Migration dan Seeding
log "=== Database Migration & Seeding ==="

# Cek apakah perlu fresh migration
if [ "${FRESH_MIGRATE:-}" = "true" ]; then
    log "Mode FRESH_MIGRATE aktif - akan menghapus dan membuat ulang semua table"
    if run_artisan "migrate:fresh --force" "Fresh migration (drop semua table)" false; then
        log "Fresh migration berhasil, akan menjalankan seeder..."
        run_artisan "db:seed --force" "Database seeding setelah fresh migration" false
    else
        log "FATAL: Fresh migration gagal"
        exit 1
    fi
else
    log "Mode migration normal (incremental)"
    if run_artisan "migrate --force" "Database migration" false; then
        log "Migration berhasil, mengecek apakah perlu seeding..."
        
        # Opsi untuk force run seeder setiap deploy
        if [ "${FORCE_SEED:-}" = "true" ]; then
            log "Mode FORCE_SEED aktif - akan menjalankan seeder paksa"
            run_artisan "db:seed --force" "Force database seeding" false
        else
            log "Mengecek apakah database kosong untuk first-time seeding..."
            USER_COUNT=$(get_user_count)
            log "Jumlah user di database: $USER_COUNT"
            
            if [ "$USER_COUNT" = "0" ]; then
                log "Database kosong, menjalankan first-time seeding..."
                run_artisan "db:seed --force" "First-time database seeding" false
                
                # Verifikasi seeding berhasil
                FINAL_USER_COUNT=$(get_user_count)
                if [ "$FINAL_USER_COUNT" != "0" ] && [[ "$FINAL_USER_COUNT" != ERROR:* ]]; then
                    log "✓ Seeding berhasil! Jumlah user sekarang: $FINAL_USER_COUNT"
                else
                    log "PERINGATAN: Seeding mungkin gagal. User count setelah seeding: $FINAL_USER_COUNT"
                fi
            else
                log "Database sudah berisi data ($USER_COUNT users), skip seeding"
                log "Tip: Set FORCE_SEED=true untuk menjalankan seeder paksa"
            fi
        fi
    else
        log "FATAL: Migration gagal"
        exit 1
    fi
fi

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
