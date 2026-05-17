<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rental;
use App\Models\RentalItem;

class AdminPageController extends Controller
{
    public function dashboard()
    {
        $totalProduk = Product::count();
        $totalPelangganAktif = Rental::where('status', 'ongoing')->distinct('user_id')->count('user_id');

        $rentalsPaymentPending = Rental::whereHas('payment', function ($query) {
            $query->where(
                'status_pembayaran',
                'waiting for verification'
        );

    })->latest()->get();

        return view('admin-pages.dashboard', compact(
            'totalProduk', 
            'totalPelangganAktif',
            'rentalsPaymentPending'
        ));
    }
}
