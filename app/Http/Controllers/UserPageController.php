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
}
