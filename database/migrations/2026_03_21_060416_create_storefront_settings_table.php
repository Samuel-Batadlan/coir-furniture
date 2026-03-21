<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('storefront_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default values
        DB::table('storefront_settings')->insert([
            ['key' => 'announcement_text',    'value' => '🌿 Free delivery on orders over ₱5,000 | Eco-friendly coconut coir furniture, made in the Philippines'],
            ['key' => 'hero_headline',        'value' => 'Furniture rooted in nature.'],
            ['key' => 'hero_subheadline',     'value' => 'Handcrafted from coconut coir fiber — durable, sustainable, and beautifully organic. Every piece tells the story of Filipino craftsmanship.'],
            ['key' => 'featured_count',       'value' => '8'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('storefront_settings');
    }
};