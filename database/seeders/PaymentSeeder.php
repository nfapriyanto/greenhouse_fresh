<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->delete();

        DB::table('payments')->insert([
            [
                'order_id' => 1,
                'method' => 'qris',
                'status' => 'belum dibayar',
                'proof' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
