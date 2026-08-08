<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        return view('cart.cart-page', compact('cart'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa'
        ]);

        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $hari = Carbon::parse($request->tanggal_sewa)
            ->diffInDays($request->tanggal_kembali);
        $hari = max(1, $hari);

        $totalHarga = $cart->calculateTotal($hari);

        return view('cart.cart-page', [
            'cart' => $cart,
            'totalHarga' => $totalHarga,
            'hari' => $hari,
            'tanggalMulai' => $request->tanggal_sewa,
            'tanggalSelesai' => $request->tanggal_kembali
        ]);
    }

    public function checkoutPage(Request $request)
    {
        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $hari = Carbon::parse($request->tanggal_sewa)
            ->diffInDays($request->tanggal_kembali);
        $hari = max(1, $hari);

        $totalHarga = $cart->calculateTotal($hari);

        return view('payments.checkout-page', [
            'cart' => $cart,
            'totalHarga' => $totalHarga,
            'tanggalSewa' => $request->tanggal_sewa,
            'tanggalKembali' => $request->tanggal_kembali
        ]);
    }
}
