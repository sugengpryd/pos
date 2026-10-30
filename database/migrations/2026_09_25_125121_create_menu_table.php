<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_id')->uniqid();
            $table->string('description');
            $table->string('kategori');
            $table->string('item_qty')->default('1');
            $table->string('uom')->default('pkg');
            $table->string('sellingPrice')->default('0');
            $table->string('flaq');
            $table->timestamps();

            // $table->foreignId('produk_id')
            //     ->nullable()
            //     ->constrained('produk')
            //     ->nullOnDelete();

            // $table->string('batch_id')->nullable();
            // $table->string('description')->nullable();
            // $table->string('uom')->nullable();
            // $table->decimal('sellingPrice', 15, 2)->default(0);
            // $table->boolean('flaq')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
