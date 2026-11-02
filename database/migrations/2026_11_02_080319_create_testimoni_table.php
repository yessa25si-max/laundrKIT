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
        Schema::create('testimoni', function (Blueprint $table) {
            $table->increments('testimoni_id');
            $table->unsignedInteger('pelanggan_id');
            $table->unsignedInteger('layanan_id');
            $table->unsignedInteger('transaksi_id')->nullable();
            $table->tinyInteger('rating')->default(5);
            $table->text('komentar');
            $table->enum('status_tampil', ['Tampilkan', 'Sembunyikan'])->default('Tampilkan');
            $table->date('tgl_ulasan');
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->cascadeOnDelete();
            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksi')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};
