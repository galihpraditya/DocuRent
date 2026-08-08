#!/bin/sh

# Jalankan optimisasi untuk production
php artisan optimize:clear
php artisan optimize

# Jalankan migrasi database
php artisan migrate --force

# Buat link storage (diabaikan jika sudah ada)
php artisan storage:link

# Jalankan Supervisor yang akan menyalakan Nginx dan PHP-FPM
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
