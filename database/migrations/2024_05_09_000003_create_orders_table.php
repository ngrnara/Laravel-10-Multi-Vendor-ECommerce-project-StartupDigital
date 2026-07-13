<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->double('product_price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->double('subtotal', 10, 2);
            $table->text('recipient_address');
            $table->string('postal_code');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->string('courier');
            $table->double('shipping_cost', 10, 2);
            $table->double('admin_fee', 10, 2);
            $table->double('total', 10, 2);
            $table->enum('status', ['Pending', 'Processing', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
