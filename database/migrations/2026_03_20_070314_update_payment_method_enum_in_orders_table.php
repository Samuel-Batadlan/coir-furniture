<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('Cash on Delivery', 'Over-the-Counter', 'GCash', 'BDO Online Banking')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('Cash on Delivery', 'Bank Transfer', 'Over-the-Counter')");
    }
};