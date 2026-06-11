<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            // ===== Data inti (selalu dijalankan) =====
            $this->call([
                UserSeeder::class,
                AdminSeeder::class,
                ProductSeeder::class,
            ]);

            // ===== Data demo/sampel (hanya di local/dev/testing) =====
            if (app()->environment(['local', 'development', 'testing'])) {
                foreach ([OrderSeeder::class, PaymentSeeder::class, CartSeeder::class] as $class) {
                    if (class_exists($class)) {
                        $this->call($class);
                    }
                }
            }
        });
    }
}
