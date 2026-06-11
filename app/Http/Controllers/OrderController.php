<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CHECKOUT PAGE
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang kosong!');

        }

        $total = collect($cart)->sum(function ($item) {

            return $item['price'] * $item['quantity'];

        });

        return view('checkout', compact('cart', 'total'));
    }

    /*
    |--------------------------------------------------------------------------
    | PLACE ORDER
    |--------------------------------------------------------------------------
    */

    public function placeOrder(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang kosong!');

        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'required',
                'string'
            ],

            'phone' => [
                'required',
                'string',
                'max:30'
            ],

            'shipping_method' => [
                'required',
                'in:instant,sameday,regular,pickup'
            ],

            'payment_method' => [
                'required',
                'in:transfer,qris,cod'
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | TOTAL PRICE
        |--------------------------------------------------------------------------
        */

        $total = collect($cart)->sum(function ($item) {

            return $item['price'] * $item['quantity'];

        });

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $order = Order::create([

            'user_id' => Auth::id(),

            'name' => $validated['name'],

            'address' => $validated['address'],

            'phone' => $validated['phone'],

            'shipping_method' => $validated['shipping_method'],

            'payment_method' => $validated['payment_method'],

            'total_price' => $total,

            'status' => 'pending',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SAVE ORDER ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'] ?? $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CLEAR CART
        |--------------------------------------------------------------------------
        */

        Session::forget('cart');

        Session::forget('cart_count');

        /*
        |--------------------------------------------------------------------------
        | COD = TIDAK PERLU UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($validated['payment_method'] == 'cod') {

            return redirect()
                ->route('orders.mine')
                ->with(

                    'success',

                    'Pesanan COD berhasil dibuat.'

                );

        }

        /*
        |--------------------------------------------------------------------------
        | TRANSFER / QRIS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('payment.upload.form', [

                'order_id' => $order->id

            ])
            ->with(

                'success',

                'Pesanan #' . $order->id . ' berhasil dibuat. Silakan upload bukti pembayaran.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - LIST ORDERS
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        $orders = Order::with('user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Order $order)
    {
        $allowed = implode(',', [

            'pending',

            'waiting_verification',

            'processing',

            'packing',

            'shipped',

            'completed',

            'cancelled'

        ]);

        $validated = $request->validate([

            'status' => [

                'required',

                "in:$allowed"

            ],

            'courier' => [
                'nullable',
                'string',
                'max:255'
            ],

            'resi' => [
                'nullable',
                'string',
                'max:255'
            ],

        ]);

        $oldStatus = $order->status;
        $order->status = $validated['status'];

        if ($validated['status'] === 'shipped') {
            $order->courier = $validated['courier'] ?? $order->courier;
            $order->resi = $validated['resi'] ?? $order->resi;
        }

        $order->save();

        if ($validated['status'] === 'completed' && $oldStatus !== 'completed') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        }

        return back()->with(

            'success',

            "Status pesanan #{$order->id} berhasil diperbarui."

        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE ORDER
    |--------------------------------------------------------------------------
    */

    public function destroy(Order $order)
    {
        $orderId = $order->id;

        $order->delete();

        return back()->with(

            'success',

            "Pesanan #{$orderId} berhasil dihapus."

        );
    }

    /*
    |--------------------------------------------------------------------------
    | USER - MY ORDERS
    |--------------------------------------------------------------------------
    */

    public function myOrders()
    {
        $orders = \App\Models\Order::where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();

        return view(
            'user.orders',
            compact('orders')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | USER - DETAIL ORDER
    |--------------------------------------------------------------------------
    */

    public function showMyOrder($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}