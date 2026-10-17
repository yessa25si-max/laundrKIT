<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'BRG-001',
                'nama_barang' => 'Deterjen Cair Floral Clean',
                'kategori' => 'Deterjen & Sabun',
                'stok' => 25,
                'satuan' => 'Liter',
                'harga_beli' => 18000,
                'status' => 'Tersedia',
            ],
            [
                'kode_barang' => 'BRG-002',
                'nama_barang' => 'Pelembut Downy Mawar Ungu',
                'kategori' => 'Pewangi & Softener',
                'stok' => 15,
                'satuan' => 'Liter',
                'harga_beli' => 24000,
                'status' => 'Tersedia',
            ],
            [
                'kode_barang' => 'BRG-003',
                'nama_barang' => 'Plastik Packing Jinjing 40x60',
                'kategori' => 'Plastik & Kemasan',
                'stok' => 120,
                'satuan' => 'Pack',
                'harga_beli' => 35000,
                'status' => 'Tersedia',
            ],
            [
                'kode_barang' => 'BRG-004',
                'nama_barang' => 'Hanger Kawat Putih Tebal',
                'kategori' => 'Peralatan & Hanger',
                'stok' => 8,
                'satuan' => 'Lusin',
                'harga_beli' => 15000,
                'status' => 'Menipis',
            ],
            [
                'kode_barang' => 'BRG-005',
                'nama_barang' => 'Parfum Laundry Sweet Snappy',
                'kategori' => 'Pewangi & Softener',
                'stok' => 10,
                'satuan' => 'Liter',
                'harga_beli' => 32000,
                'status' => 'Tersedia',
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::updateOrCreate(['kode_barang' => $barang['kode_barang']], $barang);
        }
    }
}
