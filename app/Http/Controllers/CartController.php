<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tampilkan Keranjang
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cart = Session::get('cart', []);

        return view('cart', compact('cart'));
    }

    /*
    |--------------------------------------------------------------------------
    | Tambah / Update Keranjang
    |--------------------------------------------------------------------------
    */

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = Session::get('cart', []);

        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        $image = null;

        if (!empty($product->image)) {

            // Ambil nama file saja
            $image = basename($product->image);

        }

        /*
        |--------------------------------------------------------------------------
        | QUANTITY
        |--------------------------------------------------------------------------
        */

        $quantity = (int) $request->get('quantity', 1);

        if ($quantity <= 0) {

            $quantity = 1;

        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE CART
        |--------------------------------------------------------------------------
        */

        if (isset($cart[$id])) {

            if ($request->has('override')) {

                $cart[$id]['quantity'] = $quantity;

            } else {

                $cart[$id]['quantity'] += $quantity;

            }

        } else {

            $cart[$id] = [

                'id'       => $product->id,

                'name'     => $product->name,

                'price'    => $product->price,

                'image'    => $image,

                'quantity' => $quantity

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | SAVE SESSION
        |--------------------------------------------------------------------------
        */

        Session::put('cart', $cart);

        Session::put('cart_count', count($cart));

        return redirect()
            ->back()
            ->with('success', 'Produk ditambahkan ke keranjang!');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Item
    |--------------------------------------------------------------------------
    */

    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {

            unset($cart[$id]);

            Session::put('cart', $cart);

            Session::put('cart_count', count($cart));

        }

        return redirect()
            ->back()
            ->with('success', 'Produk dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | Kosongkan Keranjang
    |--------------------------------------------------------------------------
    */

    public function clear()
    {
        Session::forget('cart');

        Session::forget('cart_count');

        return redirect()
            ->back()
            ->with('success', 'Keranjang dikosongkan!');
    }
}