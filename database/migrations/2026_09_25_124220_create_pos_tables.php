<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Produk
        |--------------------------------------------------------------------------
        */
        // Schema::create('produk', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('description');
        //     $table->string('uom')->nullable();
        //     $table->decimal('harga', 15, 2)->default(0);
        //     $table->boolean('flaq')->default(true);
        //     $table->timestamps();
        // });


        /*
        |--------------------------------------------------------------------------
        | Menu
        |--------------------------------------------------------------------------
        */
        // Schema::create('menu', function (Blueprint $table) {
        //     $table->id();

        //     $table->foreignId('produk_id')
        //         ->nullable()
        //         ->constrained('produk')
        //         ->nullOnDelete();

        //     $table->string('batch_id')->nullable();
        //     $table->string('description')->nullable();
        //     $table->string('uom')->nullable();
        //     $table->decimal('sellingPrice', 15, 2)->default(0);
        //     $table->boolean('flaq')->default(true);

        //     $table->timestamps();
        // });


        /*
        |--------------------------------------------------------------------------
        | Transaksi
        |--------------------------------------------------------------------------
        */
        // Schema::create('transaksi', function (Blueprint $table) {
        //     $table->id();

        //     $table->string('batch_id')->nullable();

        //     $table->foreignId('menu_id')
        //         ->constrained('menu')
        //         ->cascadeOnDelete();

        //     $table->decimal('qty', 15, 2)->default(0);
        //     $table->decimal('sellingPrice', 15, 2)->default(0);
        //     $table->decimal('total', 15, 2)->default(0);

        //     $table->boolean('flaq')->default(true);

        //     $table->timestamps();
        // });


        /*
        |--------------------------------------------------------------------------
        | Discount
        |--------------------------------------------------------------------------
        */
        Schema::create('discount', function (Blueprint $table) {
            $table->id();

            $table->string('batch_id')->nullable();

            $table->decimal('sellingPrice', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);

            $table->boolean('flaq')->default(true);

            $table->timestamps();
        });


        /*
        |--------------------------------------------------------------------------
        | PPN
        |--------------------------------------------------------------------------
        */
        Schema::create('ppn', function (Blueprint $table) {
            $table->id();

            $table->string('batch_id')->nullable();

            $table->decimal('sellingPrice', 15, 2)->default(0);
            $table->decimal('ppn', 15, 2)->default(0);

            $table->boolean('flaq')->default(true);

            $table->timestamps();
        });


        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */
        Schema::create('payment', function (Blueprint $table) {
            $table->id();

            $table->string('nama');

            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('pph', 15, 2)->default(0);
            $table->decimal('grandtotal', 15, 2)->default(0);

            $table->string('tipe_payment');

            $table->boolean('flaq')->default(true);

            $table->timestamps();
        });


        /*
        |--------------------------------------------------------------------------
        | Customer
        |--------------------------------------------------------------------------
        */
        Schema::create('customer', function (Blueprint $table) {
            $table->id();

            $table->string('nama')->nullable();
            $table->text('Alamat')->nullable();
            $table->string('telepon1')->nullable();
            $table->string('telepon2')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('ppn');
        Schema::dropIfExists('discount');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('customer');
    }
};
