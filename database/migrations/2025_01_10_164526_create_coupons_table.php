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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true);
            $table->timestampTz('init_at')->nullable();
            $table->timestampTz('finish_at')->nullable();
            $table->string('code');
            $table->boolean('used')->default(false);
            $table->string('type');
            $table->decimal('ammount', 8, 2);
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
