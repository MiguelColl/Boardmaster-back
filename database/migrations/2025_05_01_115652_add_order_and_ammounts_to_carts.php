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
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('taxes', 8, 2)->nullable();
            $table->decimal('shipment', 8, 2)->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('subtotal_price', 8, 2)->nullable();
            $table->decimal('total_price', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('taxes');
            $table->dropColumn('shipment');
            $table->dropColumn('discount');
            $table->dropColumn('subtotal_price');
            $table->dropColumn('total_price');
        });
    }
};
