<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Angka-angka ringkas untuk kartu KPI di dashboard
        $stats = [
            'product_count' => Product::count(),
            'order_count'   => Order::count(),
            'pending_count' => Order::where('status', 'pending')->count(),
            'revenue_sum'   => Order::sum('total_price'), // sesuaikan jika ingin hanya status tertentu
        ];

        // (Opsional) contoh tambahan: pesanan terbaru untuk ringkasan
        $recentOrders = Order::with('user')->latest('id')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
