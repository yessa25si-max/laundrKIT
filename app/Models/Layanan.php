<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $primaryKey = 'layanan_id';

    protected $fillable = [
        'kode_layanan',
        'nama_layanan',
        'kategori',
        'harga',
        'satuan',
        'durasi_jam',
        'deskripsi',
    ];

    /**
     * Relasi ke transaksi yang menggunakan layanan ini (One-to-Many).
     */
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'layanan_id', 'layanan_id');
    }
}
