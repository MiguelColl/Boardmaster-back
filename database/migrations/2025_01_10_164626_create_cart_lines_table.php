<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_lines', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->boolean('active')->default(true);
            $table->foreignId('cart_id')->constrained()->nullOnDelete();
            $table->foreignId('product_variant_id')->constrained()->nullOnDelete();
            $table->integer('units');
            $table->decimal('total_price', 8, 2);
            $table->decimal('total_price_per_unit', 8, 2);
            $table->decimal('total_base_price', 8, 2);
            $table->decimal('total_base_price_per_unit', 8, 2);
            $table->decimal('total_tax', 8, 2);
            $table->decimal('total_tax_per_unit', 8, 2);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_lines');
    }
};
