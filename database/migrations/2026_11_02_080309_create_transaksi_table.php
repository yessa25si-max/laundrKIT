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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('transaksi_id');
            $table->string('kode_transaksi', 30)->unique();
            $table->unsignedInteger('pelanggan_id');
            $table->unsignedInteger('layanan_id');
            $table->decimal('berat_jumlah', 8, 2)->default(1.00);
            $table->integer('total_biaya');
            $table->date('tgl_masuk');
            $table->date('tgl_selesai')->nullable();
            $table->enum('status', ['Baru', 'Diproses', 'Selesai', 'Diambil'])->default('Baru');
            $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
