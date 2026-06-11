<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan daftar produk ke user
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }
}
