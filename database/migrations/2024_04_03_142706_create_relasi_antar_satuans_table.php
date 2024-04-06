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
        Schema::create('relasi_antar_satuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('satuan_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('relasi_id')->references('id')->on('satuans')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('operasi', 20); // perkalian, pembagian
            $table->integer('faktor');
            $table->integer('pembagi_faktor')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relasi_antar_satuans');
    }
};
