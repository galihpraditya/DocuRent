<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserPageController extends Controller
{
    public function home()
    {
        $recommendations = Product::inRandomOrder()->take(3)->get();

        $catalogs = Product::all();

        return view('home.home-page', compact(
            'recommendations',
            'catalogs'
        ));
    }

    public function searchProducts(Request $request)
    {
        $catalogs = Product::where(
            'nama_produk',
            'like',
            '%' . $request->search . '%'
        )->get();

        $recommendations = Product::inRandomOrder()->take(3)->get();

        return view('home.home-page', compact(
            'recommendations',
            'catalogs'
        ));
    }

    public function filterProducts(Request $request)
    {
        $query = Product::query();

        // filter kategori
        if ($request->filled('kategori')) {

            $query->where(
                'nama_produk',
                'like',
                '%' . $request->kategori . '%'
            );
        }

        // sorting
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
        $recommendations = Product::inRandomOrder()->take(3)->get();

        return view('home.home-page', compact('recommendations', 'catalogs'));
    }
}
