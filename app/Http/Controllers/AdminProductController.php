<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AdminProductController extends Controller
{
    /**
     * Core seed images that should be preserved on disk for demo resets.
     */
    protected array $seedImages = [
        'products/kameracanon.jpg', 'products/sonya6400.jpg', 'products/fujifilmxt30.jpg',
        'products/lensa50.jpg', 'products/godoxsl60.jpg', 'products/ringlight.jpg',
        'products/rodego.jpg', 'products/boya.jpg', 'products/djimini3.jpg',
        'products/djiair2s.jpg', 'products/tripod.jpg', 'products/gimbal.jpg'
    ];

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin-pages.manage-products', compact('products'));
    }

    public function show(Product $product)
    {
        return view('admin-pages.product-detail', compact('product'));
    }

    public function create()
    {
        return view('admin-pages.create-product');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'harga_sewa'  => 'required|integer',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($validated);

        Cache::forget('admin_total_produk');
        Cache::forget('recommendations');

        return redirect()->route('admin.products.index')->with('success', 'Produk baru berhasil ditambahkan ke inventaris.');
    }

    public function edit(Product $product)
    {
        return view('admin-pages.edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'harga_sewa'  => 'required|integer',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($product->gambar && !in_array($product->gambar, $this->seedImages)) {
                Storage::disk('public')->delete($product->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($validated);

        Cache::forget('admin_total_produk');
        Cache::forget('recommendations');

        return redirect()->route('admin.products.index')->with('success', 'Perubahan data produk berhasil disimpan.');
    }

    public function destroy(Product $product)
    {
        if ($product->gambar && !in_array($product->gambar, $this->seedImages)) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();

        Cache::forget('admin_total_produk');
        Cache::forget('recommendations');

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus dari inventaris.');
    }
}
