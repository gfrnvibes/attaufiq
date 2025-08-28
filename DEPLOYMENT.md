# Deployment Guide - Docker & Koyeb

## Environment Variables untuk Debugging

Aplikasi ini mendukung beberapa environment variables untuk debugging dan control deployment:

### Database Seeding Control

- `FORCE_SEED=true` - Menjalankan database seeder setiap kali deploy (paksa)
- `FRESH_MIGRATE=true` - Menjalankan fresh migration (drop semua table dan buat ulang)

### Database Configuration

Aplikasi ini otomatis mengonfigurasi PostgreSQL dari Koyeb Add-on, tetapi Anda dapat override dengan:

- `DB_CONNECTION=pgsql`
- `DB_HOST=your_host`
- `DB_PORT=5432`
- `DB_DATABASE=your_database`
- `DB_USERNAME=your_username`
- `DB_PASSWORD=your_password`
- `DB_SSLMODE=prefer`

### Cache Configuration

- `CACHE_DRIVER=file` (default) atau `database`
- `APP_ENV=production` (akan mengaktifkan cache optimization)

## Debugging Deploy Issues

### 1. First Time Deploy (Database Kosong)

Untuk deploy pertama kali, seeder akan otomatis berjalan jika database kosong. 

**Expected behavior:**
- Migration akan berjalan
- Seeder akan berjalan karena user count = 0
- Admin user akan dibuat dengan email: `admin@attaufiq.com` dan password: `password`

### 2. Force Seeding

Jika Anda perlu menjalankan seeder secara paksa:

```env
FORCE_SEED=true
```

### 3. Fresh Migration (Reset Database)

⚠️ **HATI-HATI**: Ini akan menghapus semua data!

```env
FRESH_MIGRATE=true
```

### 4. Database Connection Issues

Jika ada masalah koneksi database, periksa logs untuk:
- `[timestamp] DB_CONNECTION: pgsql`
- `[timestamp] DB_HOST: your_host`
- `[timestamp] ✓ PostgreSQL siap dan terhubung`
- `[timestamp] ✓ Koneksi database berhasil`

### 5. Seeding Issues

Periksa logs untuk:
- `[timestamp] Jumlah user di database: 0`
- `[timestamp] Database kosong, menjalankan first-time seeding...`
- `[timestamp] ✓ Seeding berhasil! Jumlah user sekarang: 1`

## Troubleshooting

### Problem: Seeding tidak berjalan

**Solution 1**: Set environment variable
```env
FORCE_SEED=true
```

**Solution 2**: Reset database (akan menghapus data)
```env
FRESH_MIGRATE=true
```

### Problem: Database connection failed

1. Pastikan PostgreSQL add-on sudah terpasang di Koyeb
2. Periksa environment variables database
3. Lihat logs connection attempts

### Problem: Migration gagal

1. Periksa apakah ada konflik migration
2. Coba fresh migrate jika perlu reset
3. Pastikan database credentials benar

## Monitoring Deployment

Logs docker-entrypoint.sh akan menampilkan:

```bash
[2025-08-28 15:09:42] === Memulai Docker Entrypoint ===
[2025-08-28 15:09:42] Menyiapkan direktori dan permission...
[2025-08-28 15:09:43] Konfigurasi database...
[2025-08-28 15:09:43] DB_CONNECTION: pgsql
[2025-08-28 15:09:43] DB_HOST: your_host
[2025-08-28 15:09:44] ✓ PostgreSQL siap dan terhubung
[2025-08-28 15:09:45] === Database Migration & Seeding ===
[2025-08-28 15:09:46] ✓ Seeding berhasil! Jumlah user sekarang: 1
[2025-08-28 15:09:47] === Docker Entrypoint Selesai ===
[2025-08-28 15:09:47] Container siap menerima requests
```

## Login Default

Setelah seeding berhasil, gunakan kredensial berikut untuk login:

- **Email**: `admin@attaufiq.com`
- **Password**: `password`

⚠️ **PENTING**: Segera ganti password default setelah login pertama!
