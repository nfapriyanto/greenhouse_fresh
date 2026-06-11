<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;

class AdminDashboard extends Component
{
    public function render()
    {
        $ordersCount = Order::count();
        $productsCount = Product::count();

        return view('livewire.admin-dashboard', compact('ordersCount', 'productsCount'));
    }
}
