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
        $totalProduk = Product::count();
        $totalPelangganAktif = Rental::where('status', 'ongoing')->distinct('user_id')->count('user_id');

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

    public function resetDemo()
    {
        $seeder = new \Database\Seeders\DatabaseSeeder();
        $seeder->run();

        return redirect()->route('dashboard')->with('success', 'Data website berhasil disegarkan ke kondisi awal demo!');
    }
}
