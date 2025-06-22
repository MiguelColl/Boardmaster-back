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
        Schema::table('menus', function (Blueprint $table) {
            $table->index('node_type');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('node_type');
        });

        Schema::table('product_models', function (Blueprint $table) {
            $table->index('name');
            $table->index('brand');
            $table->index('url');
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropIndex(['node_type']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['node_type']);
        });

        Schema::table('product_models', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['brand']);
            $table->dropIndex(['url']);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropIndex(['code']);
        });
    }
};
