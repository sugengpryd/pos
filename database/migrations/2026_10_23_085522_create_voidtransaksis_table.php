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
        Schema::create('voidtransaksis', function (Blueprint $table) {
            $table->id();
            $table->text('batch_Id');
            $table->text('menu_id')->nullable();
            $table->text('qty')->nullable();
            $table->text('total');
            $table->text('flaq');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voidtransaksis');
    }
};
