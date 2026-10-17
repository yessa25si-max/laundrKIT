<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanans = [
            [
                'kode_layanan' => 'LYN-001',
                'nama_layanan' => 'Cuci Komplit Reguler',
                'kategori' => 'Cuci Kiloan',
                'harga' => 8000,
                'satuan' => 'Kg',
                'durasi_jam' => 48,
                'deskripsi' => 'Pencucian, pengeringan, setrika uap rapi, dan kemas harum.',
            ],
            [
                'kode_layanan' => 'LYN-002',
                'nama_layanan' => 'Cuci Komplit Express 6 Jam',
                'kategori' => 'Cuci Kiloan',
                'harga' => 14000,
                'satuan' => 'Kg',
                'durasi_jam' => 6,
                'deskripsi' => 'Layanan kilat cuci komplit siap ambil dalam waktu 6 jam.',
            ],
            [
                'kode_layanan' => 'LYN-003',
                'nama_layanan' => 'Setrika Saja Rapi Wangi',
                'kategori' => 'Setrika Saja',
                'harga' => 5000,
                'satuan' => 'Kg',
                'durasi_jam' => 24,
                'deskripsi' => 'Penyetrikaan uap halus, rapi, dan pengemasan plastik.',
            ],
            [
                'kode_layanan' => 'LYN-004',
                'nama_layanan' => 'Cuci Bedcover Besar (King Size)',
                'kategori' => 'Cuci Satuan',
                'harga' => 30000,
                'satuan' => 'Pcs',
                'durasi_jam' => 48,
                'deskripsi' => 'Pencucian bedcover ukuran besar dengan deterjen anti-alergi.',
            ],
            [
                'kode_layanan' => 'LYN-005',
                'nama_layanan' => 'Dry Clean Jas & Blazer',
                'kategori' => 'Dry Clean',
                'harga' => 45000,
                'satuan' => 'Pcs',
                'durasi_jam' => 72,
                'deskripsi' => 'Pencucian khusus dry cleaning pakaian formal dan jas.',
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::updateOrCreate(['kode_layanan' => $layanan['kode_layanan']], $layanan);
        }
    }
}
