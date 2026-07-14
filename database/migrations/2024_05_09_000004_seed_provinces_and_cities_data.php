<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Database\Seeders\ProvinceCitySeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        (new ProvinceCitySeeder())->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cities')->delete();
        DB::table('provinces')->delete();
    }
};
