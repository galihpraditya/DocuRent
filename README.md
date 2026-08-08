# DocuRent - Peralatan Kamera & Dokumentasi Rental

DocuRent adalah sebuah platform berbasis web yang memungkinkan pengguna untuk menyewa berbagai macam peralatan fotografi dan videografi profesional, seperti kamera, lensa, lighting, drone, dan aksesoris lainnya. Dibangun dengan framework **Laravel 12** dan styling modern menggunakan **Tailwind CSS v4**.

## Fitur Utama

- **Katalog Produk & Filter:** Jelajahi berbagai kategori produk dan urutkan berdasarkan kebutuhan Anda.
- **Sistem Keranjang & Checkout:** Hitung durasi penyewaan dengan otomatis, periksa ketersediaan stok, dan lakukan pemesanan secara efisien.
- **Autentikasi Pengguna:** Sistem registrasi dan login yang aman untuk melacak riwayat penyewaan.
- **Verifikasi Pembayaran & Status Pemesanan:** Unggah bukti pembayaran dan pantau status persetujuan dari sisi admin.
- **Frontend Premium:** Desain antarmuka (UI) dan UX yang bersih, mewah, dan sepenuhnya mobile-responsive.

## Stack Teknologi

- **Backend:** Laravel 12.x (PHP 8.2+)
- **Frontend:** Tailwind CSS v4.x (via Vite), Blade Templating Engine
- **Database:** SQLite (default), kompatibel dengan MySQL/PostgreSQL

## Prasyarat Instalasi

Pastikan Anda telah menginstal beberapa alat berikut:
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & npm (untuk meng-compile aset frontend)

## Panduan Instalasi Lokal

1. **Clone repository ini:**
   ```bash
   git clone <URL_REPO>
   cd DocuRent
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Instal dependensi Node:**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   ```
   Atur koneksi database di file `.env` (secara default akan menggunakan SQLite jika dikonfigurasi).

5. **Generate App Key:**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Seeding (Opsional):**
   ```bash
   php artisan migrate --seed
   ```
   *Catatan: Anda dapat membuat file database sqlite baru (contoh: `database/database.sqlite`) sebelum menjalankan perintah migrasi jika menggunakan SQLite.*

7. **Compile Frontend Assets:**
   ```bash
   npm run build
   ```

8. **Link Storage:**
   ```bash
   php artisan storage:link
   ```

9. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```
   Akses aplikasi di `http://127.0.0.1:8000`.

## Deployment (Docker)

Repositori ini juga menyertakan `Dockerfile` untuk deployment instan di berbagai platform Cloud (seperti Railway, Render, Fly.io, dsb) atau di Virtual Private Server (VPS) menggunakan Docker.

1. Bangun docker image:
   ```bash
   docker build -t docurent-app .
   ```
2. Jalankan container:
   ```bash
   docker run -d -p 8080:80 docurent-app
   ```
   Aplikasi Anda dapat diakses pada port 8080.

## Lisensi

Proyek ini bersifat open-source dan tersedia di bawah [MIT license](https://opensource.org/licenses/MIT).
