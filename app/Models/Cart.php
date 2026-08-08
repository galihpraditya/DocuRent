<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    protected $fillable = [
        'user_id'
    ];

    public function calculateTotal($days)
    {
        $days = max(1, $days); // Minimal 1 day
        $total = 0;

        foreach ($this->cartItems as $item) {
            if ($item->product) {
                $total += $item->product->harga_sewa * $item->jumlah * $days;
            }
        }

        return $total;
    }
}
