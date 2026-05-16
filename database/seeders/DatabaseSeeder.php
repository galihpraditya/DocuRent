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
                'deskripsi' => 'Kamera DSLR',
                'harga_sewa' => 150000,
                'stok' => 5,
                'gambar' => 'canon.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Lensa 50mm',
                'deskripsi' => 'Lensa fix',
                'harga_sewa' => 50000,
                'stok' => 10,
                'gambar' => 'lensa.jpg',
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
