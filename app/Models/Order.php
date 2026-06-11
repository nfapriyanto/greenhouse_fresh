<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    // field yang bisa diisi mass-assignment
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'shipping_method',
        'payment_method',
        'total_price',
        'status',
        'bukti_transfer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
