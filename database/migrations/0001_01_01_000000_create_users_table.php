<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 10);
            $table->enum('gender', ['Male', 'Female', 'Prefer not to say']);
            $table->date('birthdate');
            $table->string('street_address');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code', 4);
            $table->enum('role', ['customer', 'seller'])->default('customer');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};