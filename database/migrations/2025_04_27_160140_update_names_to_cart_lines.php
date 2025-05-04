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
        Schema::table('cart_lines', function (Blueprint $table) {
            $table->renameColumn('total_price_per_unit', 'price_per_unit');
            $table->renameColumn('total_base_price_per_unit', 'base_price_per_unit');
            $table->renameColumn('total_tax_per_unit', 'tax_per_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_lines', function (Blueprint $table) {
            $table->renameColumn('price_per_unit', 'total_price_per_unit');
            $table->renameColumn('base_price_per_unit', 'total_base_price_per_unit');
            $table->renameColumn('tax_per_unit', 'total_tax_per_unit');
        });
    }
};
