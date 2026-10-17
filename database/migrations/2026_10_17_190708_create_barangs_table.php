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
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('barang_id');
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 100);
            $table->enum('kategori', ['Deterjen & Sabun', 'Pewangi & Softener', 'Plastik & Kemasan', 'Peralatan & Hanger']);
            $table->integer('stok');
            $table->string('satuan', 20)->default('Pcs');
            $table->integer('harga_beli');
            $table->enum('status', ['Tersedia', 'Menipis', 'Habis'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
