<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
