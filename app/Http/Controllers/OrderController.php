<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

            'shipping_method' => 'delivery',

            'payment_method' => 'midtrans',

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
        | MIDTRANS INTEGRATION
        |--------------------------------------------------------------------------
        */
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN);
        $baseUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withBasicAuth($serverKey, '')
            ->post($baseUrl, [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $order->id . '-' . time(),
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => [
                    'first_name' => $order->name,
                    'phone' => $order->phone,
                    'email' => Auth::user()->email ?? 'customer@greenhouse.com',
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $order->update([
                    'snap_token' => $result['token'],
                    'redirect_url' => $result['redirect_url'],
                ]);

                // Clear cart session
                Session::forget('cart');
                Session::forget('cart_count');

                return redirect($result['redirect_url']);
            } else {
                \Log::error('Midtrans API Error: ' . $response->body());
                return redirect()->route('orders.mine')->with('success', 'Pesanan #' . $order->id . ' berhasil dibuat (pembayaran pending).');
            }
        } catch (\Exception $e) {
            \Log::error('Midtrans Exception: ' . $e->getMessage());
            return redirect()->route('orders.mine')->with('success', 'Pesanan #' . $order->id . ' berhasil dibuat (pembayaran pending).');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - LIST ORDERS
    |--------------------------------------------------------------------------
    */

    public function orders(Request $request)
    {
        $search = $request->query('search');

        $query = Order::with('user')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->get();

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

            'processing',

            'ready_to_ship',

            'shipped',

            'completed',

            'cancelled'

        ]);

        $validated = $request->validate([

            'status' => [

                'required',

                "in:$allowed"

            ],

        ]);

        $oldStatus = $order->status;
        $order->status = $validated['status'];

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