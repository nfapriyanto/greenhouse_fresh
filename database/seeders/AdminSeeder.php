<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@greenhouse.com'],
            [
                'name'     => 'Super Admin',
                'password' => 'admin123', // akan di-hash oleh mutator di model
            ]
        );
    }
}
