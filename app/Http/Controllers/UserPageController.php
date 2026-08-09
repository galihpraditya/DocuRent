<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class UserPageController extends Controller
{
    public function home(Request $request)
    {
        $recommendations = Cache::remember('recommendations', 600, function () {
            return Product::inRandomOrder()->take(4)->get();
        });

        $query = Product::query();

        // Pencarian (Search)
        if ($request->filled('search')) {
            $query->whereRaw('LOWER(nama_produk) LIKE LOWER(?)', ['%' . $request->search . '%']);
        }

        // Filter Kategori (berdasarkan nama_produk karena tidak ada kolom kategori)
        if ($request->filled('kategori')) {
            $query->whereRaw('LOWER(nama_produk) LIKE LOWER(?)', ['%' . $request->kategori . '%']);
        }

        // Urutan
        if ($request->filled('urutan')) {
            if ($request->urutan == 'nama') {
                $query->orderBy('nama_produk', 'asc');
            } elseif ($request->urutan == 'termurah') {
                $query->orderBy('harga_sewa', 'asc');
            } elseif ($request->urutan == 'terbaru') {
                $query->latest();
            }
        }

        $catalogs = $query->get();

        return view('home.home-page', compact(
            'recommendations',
            'catalogs'
        ));
    }

    public function profile()
    {
        return view('profile.index');
    }
}
