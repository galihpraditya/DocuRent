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

        $product = \App\Models\Product::findOrFail($request->product_id);
        
        if ($request->jumlah > $product->stok) {
            return redirect()->back()->with('error', "Stok tidak mencukupi. Tersedia: {$product->stok}");
        }

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();
        
        if ($cartItem) {
            $newJumlah = $cartItem->jumlah + $request->jumlah;
            if ($newJumlah > $product->stok) {
                return redirect()->back()->with('error', "Total kuantitas di keranjang melebihi stok yang tersedia.");
            }
            $cartItem->jumlah = $newJumlah;
            $cartItem->save();
        } 
        else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        if ($request->jumlah > $cartItem->product->stok) {
            return redirect()->back()->with('error', "Kuantitas melebihi stok yang tersedia.");
        }

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
