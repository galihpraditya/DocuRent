<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\User;

class RentalController extends Controller
{
    // ADMIN - halaman manajemen rental
    public function index()
    {
        $rentals = Rental::with('user')
            ->latest()
            ->get();

        return view('admin-pages.manage-rentals', compact('rentals'));
    }

    // USER - checkout rental dari cart
    public function store()
    {
        //
    }

    // USER + ADMIN - detail rental
    public function show(Rental $rental)
    {
        return view('rentals.rental-detail', compact('rental'));
    }

    // ADMIN - update status rental
    public function update(Request $request, Rental $rental)
    {
        //
    }

    // USER - daftar rental aktif user
    public function activeRentals()
    {
        //
    }

    // USER - riwayat rental user
    public function rentalHistory()
    {
        //
    }
}
