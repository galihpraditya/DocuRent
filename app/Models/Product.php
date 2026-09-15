<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga_sewa',
        'stok',
        'gambar'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function getKategoriAttribute()
    {
        $name = strtolower($this->nama_produk ?? '');
        if (str_contains($name, 'kamera')) return 'Kamera';
        if (str_contains($name, 'lensa')) return 'Lensa';
        if (str_contains($name, 'lighting') || str_contains($name, 'lampu') || str_contains($name, 'ring light')) return 'Lighting';
        if (str_contains($name, 'audio') || str_contains($name, 'mic') || str_contains($name, 'rode') || str_contains($name, 'boya')) return 'Audio & Mic';
        if (str_contains($name, 'drone') || str_contains($name, 'dji')) return 'Drone';
        if (str_contains($name, 'aksesoris') || str_contains($name, 'tripod') || str_contains($name, 'gimbal') || str_contains($name, 'stabilizer')) return 'Aksesoris';
        return 'Alat Dokumentasi';
    }
}
