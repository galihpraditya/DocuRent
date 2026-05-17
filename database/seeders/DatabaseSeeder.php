<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'no_hp' => '0811111111',
                'alamat' => 'Malang',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'User1',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('123456'),
                'no_hp' => '0822222222',
                'alamat' => 'Blitar',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('products')->insert([
            [
                'nama_produk' => 'Kamera Canon EOS 80D',
                'deskripsi' => 'Kamera DSLR profesional dengan sensor APS-C 24.2MP yang cocok untuk kebutuhan fotografi dan videografi.',
                'harga_sewa' => 150000,
                'stok' => 5,
                'gambar' =>'products/kameracanon.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Kamera Sony A6400',
                'deskripsi' => 'Kamera mirrorless compact dengan autofocus cepat dan kualitas video 4K yang cocok untuk content creator.',
                'harga_sewa' => 180000,
                'stok' => 4,
                'gambar' => 'products/sonya6400.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nama_produk' => 'Kamera Fujifilm XT-30',
                'deskripsi' => 'Kamera mirrorless dengan desain retro dan reproduksi warna khas Fujifilm untuk fotografi dan videografi.',
                'harga_sewa' => 170000,
                'stok' => 3,
                'gambar' => 'products/fujifilmxt30.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Lensa Sony 50mm',
                'deskripsi' => 'Lensa fix dengan bukaan lebar yang menghasilkan efek bokeh halus dan cocok untuk portrait.',
                'harga_sewa' => 50000,
                'stok' => 10,
                'gambar' => 'products/lensa50.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Lighting Godox SL60W',
                'deskripsi' => 'Lampu LED studio dengan pencahayaan stabil untuk kebutuhan foto produk dan video indoor.',
                'harga_sewa' => 120000,
                'stok' => 4,
                'gambar' => 'products/godoxsl60.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Lighting Ring Light 18 Inch',
                'deskripsi' => 'Ring light ukuran besar dengan tingkat kecerahan yang dapat diatur untuk live streaming dan makeup.',
                'harga_sewa' => 70000,
                'stok' => 8,
                'gambar' => 'products/ringlight.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Audio Rode Wireless GO',
                'deskripsi' => 'Microphone wireless compact dengan kualitas audio jernih untuk vlog, interview, dan podcast.',
                'harga_sewa' => 90000,
                'stok' => 6,
                'gambar' => 'products/rodego.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Audio Boya BY-M1',
                'deskripsi' => 'Mic clip on berkabel dengan kualitas suara yang baik untuk recording dan presentasi.',
                'harga_sewa' => 30000,
                'stok' => 12,
                'gambar' => 'products/boya.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Drone DJI Mini 3',
                'deskripsi' => 'Drone ringan dengan kamera berkualitas tinggi yang cocok untuk aerial photography dan video cinematic.',
                'harga_sewa' => 250000,
                'stok' => 3,
                'gambar' => 'products/djimini3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Drone DJI Air 2S',
                'deskripsi' => 'Drone profesional dengan sensor besar dan fitur intelligent flight untuk pengambilan gambar udara.',
                'harga_sewa' => 350000,
                'stok' => 2,
                'gambar' => 'products/djiair2s.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Aksesoris Tripod Takara',
                'deskripsi' => 'Tripod aluminium ringan dan kokoh yang mendukung stabilitas kamera saat pengambilan gambar.',
                'harga_sewa' => 40000,
                'stok' => 9,
                'gambar' => 'products/tripod.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Aksesoris Gimbal Stabilizer',
                'deskripsi' => 'Gimbal stabilizer portable untuk menghasilkan video yang lebih stabil dan minim getaran saat recording.',
                'harga_sewa' => 85000,
                'stok' => 5,
                'gambar' => 'products/gimbal.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('carts')->insert([
            [
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('cart_items')->insert([
            [
                'cart_id' => 1,
                'product_id' => 1,
                'jumlah' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'cart_id' => 1,
                'product_id' => 2,
                'jumlah' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('rentals')->insert([
            [
                'user_id' => 2,
                'tanggal_sewa' => now(),
                'tanggal_kembali' => now()->addDays(2),
                'status' => 'pending',
                'total_harga' => 250000,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('rental_items')->insert([
            [
                'rental_id' => 1,
                'product_id' => 1,
                'jumlah' => 1,
                'harga_saat_sewa' => 150000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rental_id' => 1,
                'product_id' => 2,
                'jumlah' => 2,
                'harga_saat_sewa' => 50000,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('payments')->insert([
            [
                'rental_id' => 1,
                'metode_pembayaran' => 'transfer',
                'jumlah_bayar' => 250000,
                'status_pembayaran' => 'paid',
                'tanggal_bayar' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
