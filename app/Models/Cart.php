<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Jika di masa depan mau simpan keranjang ke database
    protected $fillable = ['user_id', 'product_id', 'quantity'];
}
