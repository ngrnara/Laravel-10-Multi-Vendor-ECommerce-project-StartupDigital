<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE orders MODIFY product_id INT NULL');
        DB::statement('ALTER TABLE orders MODIFY product_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE orders MODIFY product_price DOUBLE(10,2) NULL');
        DB::statement('ALTER TABLE orders MODIFY subtotal DOUBLE(10,2) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE orders MODIFY product_id INT NOT NULL');
        DB::statement('ALTER TABLE orders MODIFY product_name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE orders MODIFY product_price DOUBLE(10,2) NOT NULL');
        DB::statement('ALTER TABLE orders MODIFY subtotal DOUBLE(10,2) NOT NULL');
    }
};
