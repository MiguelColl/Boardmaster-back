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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullOnDelete();
            $table->uuid('unique_id');
            $table->string('email');
            $table->string('delivery_name');
            $table->string('delivery_surname');
            $table->string('delivery_address');
            $table->string('delivery_zipcode');
            $table->string('delivery_province');
            $table->string('delivery_country');
            $table->string('delivery_phone');
            $table->string('delivery_comments')->nullable();
            $table->string('bill_name')->nullable();
            $table->string('bill_surname')->nullable();
            $table->string('bill_address')->nullable();
            $table->string('bill_zipcode')->nullable();
            $table->string('bill_province')->nullable();
            $table->string('bill_country')->nullable();
            $table->string('bill_identity_card')->nullable();
            $table->string('bill_fiscal_name')->nullable();
            $table->string('payment_method');
            $table->boolean('paid')->default(false);
            $table->timestampTz('paid_at')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->decimal('tax_price', 8, 2);
            $table->decimal('subtotal_price', 8, 2);
            $table->decimal('shipping_price', 8, 2);
            $table->decimal('shipping_tax', 8, 2);
            $table->decimal('discounted_price', 8, 2)->nullable();
            $table->foreignId('coupon_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('status');
            $table->timestampsTz();
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
