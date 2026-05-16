<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }
    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    protected $fillable = [
        'user_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_diambil',
        'tanggal_dikembalikan',
        'status',
        'total_harga',
    ];
}
