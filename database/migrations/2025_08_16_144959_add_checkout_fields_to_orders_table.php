<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // tambahkan di depan/di mana saja tidak masalah
            $table->string('name')->after('user_id');
            $table->text('address')->after('name');
            $table->string('phone', 30)->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'address', 'phone']);
        });
    }
};
