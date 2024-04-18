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
        Schema::create('resep_bahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resep_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('bahan_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->string('satuan', 20);
            $table->decimal('jumlah', 10, 4, false)->nullable(); // total digit dan jumlah digit decimal
            // $table->string('satuan_1', 20)->nullable();
            // $table->string('satuan_2', 20)->nullable();
            // $table->string('satuan_3', 20)->nullable();
            // $table->string('satuan_4', 20)->nullable();
            // $table->string('satuan_5', 20)->nullable();
            // $table->decimal('jumlah_1', 10, 4, false)->nullable(); // total digit dan jumlah digit decimal
            // $table->decimal('jumlah_2', 10, 4, false)->nullable(); // total digit dan jumlah digit decimal
            // $table->decimal('jumlah_3', 10, 4, false)->nullable(); // total digit dan jumlah digit decimal
            // $table->decimal('jumlah_4', 10, 4, false)->nullable(); // total digit dan jumlah digit decimal
            // $table->decimal('jumlah_5', 10, 4, false)->nullable(); // total digit dan jumlah digit decimal
            $table->string('keterangan')->nullable(); // misal bahannya telur, namun kuningnya saja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_bahans');
    }
};
