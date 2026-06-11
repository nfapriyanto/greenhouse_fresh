<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class ManageOrders extends Component
{
    public function render()
    {
        $orders = Order::with('user')->latest()->get();
        return view('livewire.manage-orders', compact('orders'));
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        $this->dispatchBrowserEvent('notify', 'Status pesanan diperbarui!');
    }
}
