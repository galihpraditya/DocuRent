<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }
}
