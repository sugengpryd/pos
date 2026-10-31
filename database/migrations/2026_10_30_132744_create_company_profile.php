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
        Schema::create('company_profile', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('company_id')->unique();
            $table->string('namaPT')->nullable();
            $table->string('namaToko');
            $table->string('alamattoko')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('flaq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profile');
    }
};
