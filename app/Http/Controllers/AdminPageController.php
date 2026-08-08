<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rental;
use App\Models\RentalItem;
use Illuminate\Support\Facades\Cache;

class AdminPageController extends Controller
{
    public function dashboard()
    {
        $totalProduk = Cache::remember('admin_total_produk', 300, function () {
            return Product::count();
        });

        $totalPelangganAktif = Cache::remember('admin_pelanggan_aktif', 300, function () {
            return Rental::where('status', 'ongoing')->distinct('user_id')->count('user_id');
        });

        $rentalsPaymentPending = Rental::with(['user', 'payment'])->whereHas('payment', function ($query) {
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
