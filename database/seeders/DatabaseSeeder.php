<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Safely resets and repopulates the entire demo catalog, users, carts, and showcase transactions.
     */
    public function run(): void
    {
        // 1. Disable Foreign Key constraints temporarily (SQLite compatible)
        DB::statement('PRAGMA foreign_keys = OFF;');

        // 2. Clear all transactional & master tables
        DB::table('payments')->delete();
        DB::table('rental_items')->delete();
        DB::table('rentals')->delete();
        DB::table('cart_items')->delete();
        DB::table('carts')->delete();
        DB::table('products')->delete();
        DB::table('users')->delete();

        // Reset SQLite auto-increment counters if sqlite_sequence exists
        try {
            DB::statement("DELETE FROM sqlite_sequence WHERE name IN ('users', 'products', 'carts', 'cart_items', 'rentals', 'rental_items', 'payments');");
        } catch (\Throwable $e) {
            // Ignore if table doesn't have sequence records yet
        }

        // 3. Seed Users (Admin & Customers)
        DB::table('users')->insert([
            [
                'id' => 1,
                'nama' => 'Admin DocuRent',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'no_hp' => '081234567890',
                'alamat' => 'Studio DocuRent, Jl. Ijen No. 10, Malang Pusat',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nama' => 'Dimas Pratama',
                'username' => 'dimas',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('123456'),
                'no_hp' => '082198765432',
                'alamat' => 'Jl. Soekarno Hatta No. 45, Lowokwaru, Malang',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nama' => 'Nadia Safira',
                'username' => 'nadia',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('123456'),
                'no_hp' => '085612345678',
                'alamat' => 'Jl. Bandung No. 8, Klojen, Malang',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 4. Seed Products (12 items across 6 categories with healthy stocks)
        DB::table('products')->insert([
            [
                'id' => 1,
                'nama_produk' => 'Kamera Canon EOS 80D',
                'deskripsi' => 'Kamera DSLR profesional dengan sensor APS-C 24.2MP dan Dual Pixel AF yang responsif. Ideal untuk kebutuhan foto studio, portrait, dan liputan acara.',
                'harga_sewa' => 150000,
                'stok' => 5,
                'gambar' => 'products/kameracanon.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nama_produk' => 'Kamera Sony A6400',
                'deskripsi' => 'Kamera mirrorless compact dengan Real-time Eye AF tercepat dan perekaman video 4K HDR tanpa batas durasi. Favorit para content creator dan videografer.',
                'harga_sewa' => 180000,
                'stok' => 4,
                'gambar' => 'products/sonya6400.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nama_produk' => 'Kamera Fujifilm XT-30',
                'deskripsi' => 'Kamera mirrorless dengan desain retro klasik, film simulation khas Fujifilm, dan sensor X-Trans IV untuk hasil warna yang otentik tanpa banyak grading.',
                'harga_sewa' => 170000,
                'stok' => 3,
                'gambar' => 'products/fujifilmxt30.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'nama_produk' => 'Lensa Sony 50mm',
                'deskripsi' => 'Lensa prime 50mm F1.8 dengan bukaan diafragma besar untuk menghasilkan separasi background bokeh lembut dan performa low-light yang superior.',
                'harga_sewa' => 50000,
                'stok' => 8,
                'gambar' => 'products/lensa50.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'nama_produk' => 'Lighting Godox SL60W',
                'deskripsi' => 'Continuous video light LED 60W 5600K Daylight dengan CRI tinggi. Dilengkapi Bowens mount untuk berbagai aksesoris softbox studio.',
                'harga_sewa' => 120000,
                'stok' => 4,
                'gambar' => 'products/godoxsl60.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'nama_produk' => 'Lighting Ring Light 18 Inch',
                'deskripsi' => 'Ring light 18 inci bi-color dengan kontrol kecerahan presisi, dudukan smartphone, dan stand kokoh untuk live streaming, beauty, dan podcast.',
                'harga_sewa' => 70000,
                'stok' => 6,
                'gambar' => 'products/ringlight.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'nama_produk' => 'Audio Rode Wireless GO',
                'deskripsi' => 'Sistem mikrofon wireless ultra-kompak dengan transmitter bawaan mic omnidirectional. Jangkauan transmisi digital 2.4GHz hingga 70 meter.',
                'harga_sewa' => 90000,
                'stok' => 5,
                'gambar' => 'products/rodego.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'nama_produk' => 'Audio Boya BY-M1',
                'deskripsi' => 'Mic clip-on lavalier kabel 6 meter dengan suara vokal jernih dan noise rendah. Kompatibel dengan kamera DSLR, mirrorless, PC, dan smartphone.',
                'harga_sewa' => 30000,
                'stok' => 10,
                'gambar' => 'products/boya.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'nama_produk' => 'Drone DJI Mini 3',
                'deskripsi' => 'Drone ultralight di bawah 249 gram dengan kamera 4K HDR dan fitur True Vertical Shooting untuk konten reels/TikTok berkualitas tinggi.',
                'harga_sewa' => 250000,
                'stok' => 3,
                'gambar' => 'products/djimini3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'nama_produk' => 'Drone DJI Air 2S',
                'deskripsi' => 'Drone profesional dengan sensor 1-inci 20MP, video 5.4K/30fps, sensor rintangan 4 arah, dan teknologi MasterShots sinematik.',
                'harga_sewa' => 350000,
                'stok' => 2,
                'gambar' => 'products/djiair2s.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'nama_produk' => 'Aksesoris Tripod Takara',
                'deskripsi' => 'Tripod aluminium kokoh dengan panhead 3-arah, quick release plate, dan tinggi maksimal 150cm untuk stabilitas kamera foto dan video.',
                'harga_sewa' => 40000,
                'stok' => 7,
                'gambar' => 'products/tripod.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'nama_produk' => 'Aksesoris Gimbal Stabilizer',
                'deskripsi' => 'Gimbal stabilizer 3-axis dengan motor kuat, baterai tahan hingga 12 jam, dan algoritma stabilisasi tingkat tinggi untuk rekaman video sinematik.',
                'harga_sewa' => 85000,
                'stok' => 4,
                'gambar' => 'products/gimbal.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 5. Seed Cart & Items (User 2 / Dimas Pratama has 1 ready cart item)
        DB::table('carts')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('cart_items')->insert([
            [
                'id' => 1,
                'cart_id' => 1,
                'product_id' => 4, // Lensa Sony 50mm
                'jumlah' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 6. Seed Showcase Rentals (Covering Pending Verification, Ongoing, Completed, Cancelled)
        DB::table('rentals')->insert([
            // Rental 1: Menunggu Verifikasi Pembayaran (Admin can test verification directly on Dashboard)
            [
                'id' => 1,
                'user_id' => 2,
                'tanggal_sewa' => now()->toDateString(),
                'tanggal_kembali' => now()->addDays(2)->toDateString(),
                'status' => 'pending',
                'total_harga' => 360000,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2)
            ],
            // Rental 2: Sedang Berlangsung (Ongoing rental)
            [
                'id' => 2,
                'user_id' => 3,
                'tanggal_sewa' => now()->subDay()->toDateString(),
                'tanggal_kembali' => now()->addDay()->toDateString(),
                'status' => 'ongoing',
                'total_harga' => 220000,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subHours(12)
            ],
            // Rental 3: Selesai (Completed)
            [
                'id' => 3,
                'user_id' => 2,
                'tanggal_sewa' => now()->subDays(5)->toDateString(),
                'tanggal_kembali' => now()->subDays(3)->toDateString(),
                'status' => 'completed',
                'total_harga' => 120000,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3)
            ],
            // Rental 4: Dibatalkan (Cancelled)
            [
                'id' => 4,
                'user_id' => 3,
                'tanggal_sewa' => now()->subDays(2)->toDateString(),
                'tanggal_kembali' => now()->subDays(1)->toDateString(),
                'status' => 'cancelled',
                'total_harga' => 250000,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ]
        ]);

        // 7. Seed Rental Items for each Rental
        DB::table('rental_items')->insert([
            // Items for Rental 1
            [
                'id' => 1,
                'rental_id' => 1,
                'product_id' => 2, // Sony A6400
                'jumlah' => 1,
                'harga_saat_sewa' => 180000,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2)
            ],
            // Items for Rental 2
            [
                'id' => 2,
                'rental_id' => 2,
                'product_id' => 3, // Fujifilm XT-30
                'jumlah' => 1,
                'harga_saat_sewa' => 170000,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
            [
                'id' => 3,
                'rental_id' => 2,
                'product_id' => 4, // Lensa Sony 50mm
                'jumlah' => 1,
                'harga_saat_sewa' => 50000,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
            // Items for Rental 3
            [
                'id' => 4,
                'rental_id' => 3,
                'product_id' => 5, // Lighting Godox SL60W
                'jumlah' => 1,
                'harga_saat_sewa' => 120000,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5)
            ],
            // Items for Rental 4
            [
                'id' => 5,
                'rental_id' => 4,
                'product_id' => 9, // Drone DJI Mini 3
                'jumlah' => 1,
                'harga_saat_sewa' => 250000,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ]
        ]);

        // 8. Seed Payments
        DB::table('payments')->insert([
            // Payment for Rental 1: Menunggu Verifikasi with real proof image
            [
                'id' => 1,
                'rental_id' => 1,
                'metode_pembayaran' => 'transfer',
                'jumlah_bayar' => 360000,
                'status_pembayaran' => 'waiting for verification',
                'bukti_pembayaran' => 'payment-proofs/Ia0UMRj64zvKWkFV3AgyGinVbr8PzfXcXnONQWFr.png',
                'tanggal_bayar' => now()->subHours(1),
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(1)
            ],
            // Payment for Rental 2: Lunas
            [
                'id' => 2,
                'rental_id' => 2,
                'metode_pembayaran' => 'transfer',
                'jumlah_bayar' => 220000,
                'status_pembayaran' => 'paid',
                'bukti_pembayaran' => 'payment-proofs/YHdcvdpEC5tvIn28mP5X8ZzdNQ3V4vaxrqi6Iw5j.png',
                'tanggal_bayar' => now()->subDay(),
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
            // Payment for Rental 3: Lunas
            [
                'id' => 3,
                'rental_id' => 3,
                'metode_pembayaran' => 'transfer',
                'jumlah_bayar' => 120000,
                'status_pembayaran' => 'paid',
                'bukti_pembayaran' => null,
                'tanggal_bayar' => now()->subDays(5),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5)
            ],
            // Payment for Rental 4: Ditolak / Gagal
            [
                'id' => 4,
                'rental_id' => 4,
                'metode_pembayaran' => 'transfer',
                'jumlah_bayar' => 250000,
                'status_pembayaran' => 'failed',
                'bukti_pembayaran' => 'payment-proofs/dTh7gFj5mxGlPxQpqJMlNVOUz9XvkXZ4whfwTPkF.png',
                'tanggal_bayar' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ]
        ]);

        // 9. Re-enable Foreign Key constraints
        DB::statement('PRAGMA foreign_keys = ON;');

        // 10. Flush Application Cache to synchronize dashboard stats immediately
        Cache::forget('admin_total_produk');
        Cache::forget('admin_pelanggan_aktif');
        Cache::flush();
    }
}
