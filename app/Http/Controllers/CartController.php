<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; //

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        return view('cart.cart-page', compact('cart'));
    }
}
