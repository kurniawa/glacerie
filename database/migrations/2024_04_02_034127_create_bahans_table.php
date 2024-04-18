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
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('othername')->nullable();
            $table->string('detailname')->nullable();
            // $table->string('satuan_1', 20)->nullable();
            // $table->string('satuan_2', 20)->nullable();
            // $table->string('satuan_3', 20)->nullable();
            // $table->string('satuan_4', 20)->nullable();
            // $table->string('satuan_5', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahans');
    }
};
