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
}
