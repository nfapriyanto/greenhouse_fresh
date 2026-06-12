<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // KPI statistics
        $stats = [
            'product_count'  => Product::count(),
            'order_count'    => Order::count(),
            'customer_count' => User::count(),
            'revenue_sum'    => Order::where('status', '!=', 'cancelled')->sum('total_price'),
        ];

        // Top 5 best selling products
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(5)
            ->get();

        // Low stock products (< 5 stock)
        $lowStockProducts = Product::where('stock', '<', 5)
            ->orderBy('stock', 'asc')
            ->get();

        // Sales graph for last 7 days
        $salesData = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->where('status', '!=', 'cancelled')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $chartLabels = [];
        $chartValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('d M');
            $chartLabels[] = $label;
            $chartValues[] = (float) ($salesData[$date] ?? 0);
        }

        return view('admin.dashboard', compact('stats', 'topProducts', 'lowStockProducts', 'chartLabels', 'chartValues'));
    }
}
