<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['Pending', 'Processing', 'Completed', 'Cancelled'])->default('Pending');
            $table->enum('payment_method', ['Cash on Delivery', 'Bank Transfer', 'Over-the-Counter']);
            $table->enum('delivery_method', ['Pickup', 'Delivery']);
            $table->string('delivery_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};