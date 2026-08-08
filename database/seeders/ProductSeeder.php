<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ["nama_produk"=>"Kamera Canon EOS 80D","deskripsi"=>"Kamera DSLR profesional dengan sensor APS-C 24.2MP yang cocok untuk kebutuhan fotografi dan videografi.","harga_sewa"=>150000,"stok"=>0,"gambar"=>"products/kameracanon.jpg"],
            ["nama_produk"=>"Kamera Sony A6400","deskripsi"=>"Kamera mirrorless compact dengan autofocus cepat dan kualitas video 4K yang cocok untuk content creator.","harga_sewa"=>180000,"stok"=>0,"gambar"=>"products/sonya6400.jpg"],
            ["nama_produk"=>"Kamera Fujifilm XT-30","deskripsi"=>"Kamera mirrorless dengan desain retro dan reproduksi warna khas Fujifilm untuk fotografi dan videografi.","harga_sewa"=>170000,"stok"=>2,"gambar"=>"products/fujifilmxt30.jpg"],
            ["nama_produk"=>"Lensa Sony 50mm","deskripsi"=>"Lensa fix dengan bukaan lebar yang menghasilkan efek bokeh halus dan cocok untuk portrait.","harga_sewa"=>50000,"stok"=>9,"gambar"=>"products/lensa50.jpg"],
            ["nama_produk"=>"Lighting Godox SL60W","deskripsi"=>"Lampu LED studio dengan pencahayaan stabil untuk kebutuhan foto produk dan video indoor.","harga_sewa"=>120000,"stok"=>4,"gambar"=>"products/godoxsl60.jpg"],
            ["nama_produk"=>"Lighting Ring Light 18 Inch","deskripsi"=>"Ring light ukuran besar dengan tingkat kecerahan yang dapat diatur untuk live streaming dan makeup.","harga_sewa"=>70000,"stok"=>8,"gambar"=>"products/ringlight.jpg"],
            ["nama_produk"=>"Audio Rode Wireless GO","deskripsi"=>"Microphone wireless compact dengan kualitas audio jernih untuk vlog, interview, dan podcast.","harga_sewa"=>90000,"stok"=>6,"gambar"=>"products/rodego.jpg"],
            ["nama_produk"=>"Audio Boya BY-M1","deskripsi"=>"Mic clip on berkabel dengan kualitas suara yang baik untuk recording dan presentasi.","harga_sewa"=>30000,"stok"=>8,"gambar"=>"products/boya.jpg"],
            ["nama_produk"=>"Drone DJI Mini 3","deskripsi"=>"Drone ringan dengan kamera berkualitas tinggi yang cocok untuk aerial photography dan video cinematic.","harga_sewa"=>250000,"stok"=>0,"gambar"=>"products/djimini3.jpg"],
            ["nama_produk"=>"Drone DJI Air 2S","deskripsi"=>"Drone profesional dengan sensor besar dan fitur intelligent flight untuk pengambilan gambar udara.","harga_sewa"=>350000,"stok"=>2,"gambar"=>"products/djiair2s.jpg"],
            ["nama_produk"=>"Aksesoris Tripod Takara","deskripsi"=>"Tripod aluminium ringan dan kokoh yang mendukung stabilitas kamera saat pengambilan gambar.","harga_sewa"=>40000,"stok"=>9,"gambar"=>"products/tripod.jpg"],
            ["nama_produk"=>"Aksesoris Gimbal Stabilizer","deskripsi"=>"Gimbal stabilizer portable untuk menghasilkan video yang lebih stabil dan minim getaran saat recording.","harga_sewa"=>85000,"stok"=>5,"gambar"=>"products/gimbal.jpg"]
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'nama_produk' => $product['nama_produk'],
                'deskripsi' => $product['deskripsi'],
                'harga_sewa' => $product['harga_sewa'],
                'stok' => $product['stok'],
                'gambar' => $product['gambar'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
