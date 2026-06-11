<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $product = Product::first();

        if ($user && $product) {
            $order = Order::create([
                'user_id'         => $user->id,
                'name'            => 'Rachma',
                'address'         => 'Jl. Lebak Sari No. 123',
                'phone'           => '081315717953',
                'shipping_method' => 'sameday',      // instant|sameday|regular
                'payment_method'  => 'qris',         // transfer|qris|cod
                'total_price'     => $product->price * 2,
                'status'          => 'completed',     // Selesai agar muncul di laporan default
            ]);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => 2,
                'price'      => $product->price,
            ]);
        }
    }
}
