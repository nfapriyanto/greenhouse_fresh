<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function updateStatus(Order $order, $status)
    {
        $order->status = $status;
        $order->save();
        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
