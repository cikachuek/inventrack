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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang');
        $table->string('kode_barang')->unique();
        $table->integer('stok');
        $table->integer('harga');
        $table->string('kondisi');
        $table->string('lokasi');
        $table->text('deskripsi');
        $table->text('image');
        $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
