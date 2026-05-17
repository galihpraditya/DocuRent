<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();
        
        if ($cartItem) {
            $cartItem->jumlah += $request->jumlah;
            $cartItem->save();
        } 
        else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $cartItem->update([
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('cart.index');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index');
    }
}
