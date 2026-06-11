<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipment extends Model
{
    protected $fillable = ['order_id', 'method'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
