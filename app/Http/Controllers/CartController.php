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
            'tanggal_kembali' => 'required|date|after:tanggal_sewa'
        ]);

        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        $hari = Carbon::parse($request->tanggal_sewa)
            ->diffInDays($request->tanggal_kembali);

        $totalHarga = 0;

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
            'hari' => $hari,
            'tanggalMulai' => $request->tanggal_sewa,
            'tanggalSelesai' => $request->tanggal_kembali
        ]);
    }

    // USER - masuk ke checkout
    public function checkoutPage(Request $request)
    {
        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        $hari = Carbon::parse($request->tanggal_sewa)
            ->diffInDays($request->tanggal_kembali);

        $totalHarga = 0;

        foreach ($cart->cartItems as $item) {

            $subtotal =
                $item->product->harga_sewa *
                $item->jumlah *
                $hari;

            $totalHarga += $subtotal;
        }

        return view('payments.checkout-page', [
            'cart' => $cart,
            'totalHarga' => $totalHarga,
            'tanggalSewa' => $request->tanggal_sewa,
            'tanggalKembali' => $request->tanggal_kembali
        ]);
    }
}
