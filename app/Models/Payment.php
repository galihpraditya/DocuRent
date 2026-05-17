<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Payment;

class Payment extends Model
{
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    protected $fillable = [
        'rental_id',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_pembayaran',
        'tanggal_bayar',
    ];
}
