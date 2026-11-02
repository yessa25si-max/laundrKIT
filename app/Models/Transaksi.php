<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'kode_transaksi',
        'pelanggan_id',
        'layanan_id',
        'berat_jumlah',
        'total_biaya',
        'tgl_masuk',
        'tgl_selesai',
        'status',
        'status_pembayaran',
        'catatan',
    ];

    /**
     * Relasi ke model Pelanggan (Many-to-One).
     * Setiap transaksi dimiliki oleh satu pelanggan.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    /**
     * Relasi ke model Layanan (Many-to-One).
     * Setiap transaksi menggunakan satu jenis layanan laundry.
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }
}
