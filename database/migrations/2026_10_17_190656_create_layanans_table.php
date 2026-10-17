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
        Schema::create('layanan', function (Blueprint $table) {
            $table->increments('layanan_id');
            $table->string('kode_layanan', 20)->unique();
            $table->string('nama_layanan', 100);
            $table->enum('kategori', ['Cuci Kiloan', 'Cuci Satuan', 'Dry Clean', 'Setrika Saja']);
            $table->integer('harga');
            $table->string('satuan', 20)->default('Kg');
            $table->integer('durasi_jam')->default(24);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
