<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Cart;
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

    public function calculate(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai'
        ]);

        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        // hitung jumlah hari rental
        $hari = \Carbon\Carbon::parse($request->tanggal_mulai)
            ->diffInDays($request->tanggal_selesai);

        $totalHarga = 0;

        // hitung total semua item
        foreach ($cart->cartItems as $item) {

            $subtotal =
                $item->product->harga_sewa *
                $item->jumlah *
                $hari;

            $totalHarga += $subtotal;
        }

        return view('cart.cart-page', [
            'cart' => $cart,
            'totalHarga' => $totalHarga,
            'tanggalMulai' => $request->tanggal_mulai,
            'tanggalSelesai' => $request->tanggal_selesai
        ]);
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
