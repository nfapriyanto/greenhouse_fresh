<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // aman terhadap foreign key: pakai delete, bukan truncate
        DB::table('carts')->delete();

        // contoh data (opsional)
        // DB::table('carts')->insert([
        //     ['user_id' => 1, 'product_id' => 1, 'quantity' => 2],
        // ]);
    }
}
