<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User default
        User::updateOrCreate(
            ['email' => 'user@greenhouse.com'],
            [
                'name' => 'Default User',
                'password' => Hash::make('user123'),
            ]
        );

        // Admin default
        User::updateOrCreate(
            ['email' => 'admin@greenhouse.com'],
            [
                'name' => 'Default Admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
