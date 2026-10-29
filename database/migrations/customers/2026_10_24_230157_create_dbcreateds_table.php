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
        Schema::create('dbcreateds', function (Blueprint $table) {
            $table->id();
            $table->text('users_id')->nullable();
            $table->text('db_name')->nullable();
            $table->text('size')->nullable();
            $table->text('path')->nullable();
            $table->text('flaq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dbcreateds');
    }
};
