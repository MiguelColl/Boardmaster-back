<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->string('node_type');
            $table->string('path');
            $table->timestampsTz();
        });

        $query = 'ALTER TABLE categories ALTER COLUMN path TYPE "ltree" USING "path"::"ltree";';
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
