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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->nullOnDelete();
            $table->foreignId('order_id')->constrained()->nullOnDelete();
            $table->string('sku');
            $table->integer('units');
            $table->string('name');
            $table->decimal('price_unit', 8, 2);
            $table->decimal('price_unit_base', 8, 2);
            $table->decimal('price_total', 8, 2);
            $table->decimal('price_total_base', 8, 2);
            $table->decimal('original_price', 8, 2);
            $table->decimal('tax_value', 8, 2);
            $table->decimal('tax_unit', 8, 2);
            $table->decimal('tax_total', 8, 2);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
