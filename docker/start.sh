#!/bin/sh

# Jalankan optimisasi untuk production
php artisan optimize:clear
php artisan optimize

# Pastikan file database sqlite ada jika menggunakan sqlite
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite

# Jalankan migrasi database
php artisan migrate --force

# Masukkan data awal jika database masih kosong
php artisan db:seed --force

# Buat link storage (diabaikan jika sudah ada)
php artisan storage:link

# Perbaiki izin file yang mungkin dibuat oleh root
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Jalankan Supervisor yang akan menyalakan Nginx dan PHP-FPM
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
