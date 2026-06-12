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

        // Check stock of all items in cart before checkout
        foreach ($cart as $productId => $item) {
            $product = Product::find($item['id'] ?? $productId);
            if (!$product || $item['quantity'] > $product->stock) {
                $name = $product ? $product->name : 'Produk';
                $available = $product ? $product->stock : 0;
                return redirect()
                    ->route('cart.index')
                    ->with('error', "Stok produk '{$name}' tidak mencukupi untuk pesanan Anda. Tersedia: {$available}.");
            }
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
                ],
                'callbacks' => [
                    'finish' => route('orders.mine'),
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
        $status = $request->query('status');

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

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
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

    /*
    |--------------------------------------------------------------------------
    | USER - CANCEL ORDER
    |--------------------------------------------------------------------------
    */

    public function cancel(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $order->update(['status' => 'cancelled']);

        return redirect()
            ->back()
            ->with('success', 'Pesanan #' . $order->id . ' berhasil dibatalkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | USER - EDIT ORDER
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $order = Order::with('items.product')->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $allProducts = \App\Models\Product::orderBy('name')->get();

        return view('orders.edit', compact('order', 'allProducts'));
    }

    public function updateUserOrder(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string',
            'phone'   => 'required|string|max:20',
            'items'   => 'required|array',
            'items.*' => 'required|integer|min:0',
        ]);

        // Filter out items with 0 quantity
        $itemsData = array_filter($request->input('items'), function($qty) {
            return $qty > 0;
        });

        if (empty($itemsData)) {
            return redirect()->back()->withErrors(['items' => 'Pesanan harus memiliki minimal 1 produk.'])->withInput();
        }

        // Validate stock first before modifying database
        foreach ($itemsData as $productId => $qty) {
            $product = \App\Models\Product::findOrFail($productId);
            if ($product->stock < $qty) {
                return redirect()->back()->withErrors(['items' => 'Stok produk "' . $product->name . '" tidak mencukupi. Tersedia: ' . $product->stock])->withInput();
            }
        }

        // Delete existing items
        $order->items()->delete();

        $totalPrice = 0;
        foreach ($itemsData as $productId => $qty) {
            $product = \App\Models\Product::findOrFail($productId);

            $order->items()->create([
                'product_id' => $productId,
                'quantity'   => $qty,
                'price'      => $product->price,
            ]);

            $totalPrice += $product->price * $qty;
        }

        // Update order info
        $order->update([
            'name'        => $request->input('name'),
            'address'     => $request->input('address'),
            'phone'       => $request->input('phone'),
            'total_price' => $totalPrice,
        ]);

        // Regenerate Midtrans Snap Token
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN);
        $baseUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withBasicAuth($serverKey, '')
            ->post($baseUrl, [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $order->id . '-' . time(),
                    'gross_amount' => (int) $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $order->name,
                    'phone' => $order->phone,
                    'email' => Auth::user()->email ?? 'customer@greenhouse.com',
                ],
                'callbacks' => [
                    'finish' => route('orders.mine'),
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $order->update([
                    'snap_token' => $result['token'],
                    'redirect_url' => $result['redirect_url'],
                ]);
            } else {
                \Log::error('Midtrans API Error during edit: ' . $response->body());
            }
        } catch (\Exception $e) {
            \Log::error('Midtrans Exception during edit: ' . $e->getMessage());
        }

        return redirect()
            ->route('orders.mine')
            ->with('success', 'Pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}