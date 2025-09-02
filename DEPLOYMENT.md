# Deployment Guide - Docker & Koyeb

## ⚠️ PERUBAHAN PENTING: Manual Database Migration

**Mulai sekarang, database migration dan seeding TIDAK dilakukan secara otomatis oleh container Docker.** 
Anda perlu menjalankan migration dan seeding secara manual dari terminal lokal.

### Cara Menjalankan Migration Manual

```bash
# 1. Migration database
php artisan migrate

# 2. Seeding database (jika diperlukan)
php artisan db:seed

# 3. Fresh migration (reset semua tabel) - HATI-HATI akan menghapus data!
php artisan migrate:fresh --seed
```

## Environment Variables

Aplikasi ini mendukung beberapa environment variables untuk konfigurasi:

### Database Configuration

Aplikasi ini otomatis mengonfigurasi PostgreSQL dari Koyeb Add-on, tetapi Anda dapat override dengan:

- `DB_CONNECTION=pgsql`
- `DB_HOST=your_host`
- `DB_PORT=5432`
- `DB_DATABASE=your_database`
- `DB_USERNAME=your_username`
- `DB_PASSWORD=your_password`
- `DB_SSLMODE=require` (wajib untuk Koyeb PostgreSQL)
- `DB_OPTIONS=endpoint=your_endpoint_id` (untuk Koyeb PostgreSQL)

**Penting untuk Koyeb PostgreSQL:**
- `DB_OPTIONS` harus berisi `endpoint=<endpoint_id>`
- Endpoint ID adalah bagian pertama dari hostname (sebelum tanda `-`)
- Contoh: untuk host `ep-sweet-wildflower-a2mi4z5f.eu-central-1.pg.koyeb.app`, endpoint ID adalah `ep-sweet-wildflower-a2mi4z5f`
- SSL Mode harus `require`

### Cache Configuration

- `CACHE_DRIVER=file` (default) atau `database`
- `APP_ENV=production` (akan mengaktifkan cache optimization)

## Debugging Deploy Issues

### 1. Database Connection Issues

Jika ada masalah koneksi database, periksa logs untuk:
- `[timestamp] DB_CONNECTION: pgsql`
- `[timestamp] DB_HOST: your_host`
- `[timestamp] ✓ PostgreSQL siap dan terhubung`
- `[timestamp] ✓ Koneksi database berhasil`

## Troubleshooting

### Problem: Database connection failed

1. Pastikan PostgreSQL add-on sudah terpasang di Koyeb
2. Periksa environment variables database
3. Lihat logs connection attempts

### Problem: Migration atau Seeding gagal

Karena migration dan seeding sekarang dilakukan manual, pastikan:
1. Database credentials sudah benar
2. Koneksi ke database dapat terhubung
3. Jalankan perintah dari terminal lokal dengan environment yang tepat

### Problem: Upload File dengan Filament Spatie Media Library Gagal

**Gejala**: Upload loading terus, file tidak terupload

**Penyebab Umum**:
1. APP_URL tidak sesuai dengan domain production
2. Storage symbolic link belum dibuat
3. Permission direktori storage
4. Queue conversion yang tidak berjalan

**Solusi**:

1. **Set APP_URL yang benar**:
```env
APP_URL=https://your-actual-domain.koyeb.app
```

2. **Set environment variables media library**:
```env
FILESYSTEM_DISK=public
MEDIA_DISK=public
QUEUE_CONNECTION=sync
QUEUE_CONVERSIONS_BY_DEFAULT=false
IMAGE_DRIVER=gd
```

3. **Pastikan direktori storage sudah ada** (sudah otomatis dibuat di docker-entrypoint.sh):
   - `storage/app/public`
   - `storage/media-library/temp`
   - `public/storage` (symbolic link)

4. **Debug dengan logs**:
   - Cek network tab browser untuk error 500/400
   - Lihat Laravel logs di `storage/logs/laravel.log`

## Monitoring Deployment

Logs docker-entrypoint.sh akan menampilkan:

```bash
[2025-08-28 15:09:42] === Memulai Docker Entrypoint ===
[2025-08-28 15:09:42] Menyiapkan direktori dan permission...
[2025-08-28 15:09:43] Konfigurasi database...
[2025-08-28 15:09:43] DB_CONNECTION: pgsql
[2025-08-28 15:09:43] DB_HOST: your_host
[2025-08-28 15:09:44] ✓ PostgreSQL siap dan terhubung
[2025-08-28 15:09:45] ✓ Koneksi database berhasil
[2025-08-28 15:09:46] INFO: Database migration dan seeding tidak dilakukan secara otomatis.
[2025-08-28 15:09:46] INFO: Jalankan 'php artisan migrate' dan 'php artisan db:seed' secara manual dari terminal lokal.
[2025-08-28 15:09:47] === Docker Entrypoint Selesai ===
[2025-08-28 15:09:47] Container siap menerima requests
```

## Login Default

Setelah seeding berhasil, gunakan kredensial berikut untuk login:

- **Email**: `admin@attaufiq.com`
- **Password**: `password`

⚠️ **PENTING**: Segera ganti password default setelah login pertama!
