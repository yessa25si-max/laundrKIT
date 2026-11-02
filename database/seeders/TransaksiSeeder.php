<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds using Eloquent ORM.
     */
    public function run(): void
    {
        $pelanggan1 = Pelanggan::first();
        $pelanggan2 = Pelanggan::skip(1)->first() ?? $pelanggan1;
        $pelanggan3 = Pelanggan::skip(2)->first() ?? $pelanggan1;
        $pelanggan4 = Pelanggan::skip(3)->first() ?? $pelanggan1;
        $pelanggan5 = Pelanggan::skip(4)->first() ?? $pelanggan1;

        $layanan1 = Layanan::first();
        $layanan2 = Layanan::skip(1)->first() ?? $layanan1;
        $layanan3 = Layanan::skip(2)->first() ?? $layanan1;
        $layanan4 = Layanan::skip(3)->first() ?? $layanan1;
        $layanan5 = Layanan::skip(4)->first() ?? $layanan1;

        if (! $pelanggan1 || ! $layanan1) {
            return;
        }

        $transaksiData = [
            [
                'kode_transaksi' => 'TRX-20261101-001',
                'pelanggan_id' => $pelanggan1->pelanggan_id,
                'layanan_id' => $layanan1->layanan_id,
                'berat_jumlah' => 4.5,
                'total_biaya' => 36000,
                'tgl_masuk' => '2026-11-01',
                'tgl_selesai' => '2026-11-03',
                'status' => 'Diproses',
                'status_pembayaran' => 'Lunas',
                'catatan' => 'Pakaian kerja kemeja putih jangan dicampur dengan baju luntur.',
            ],
            [
                'kode_transaksi' => 'TRX-20261101-002',
                'pelanggan_id' => $pelanggan2->pelanggan_id,
                'layanan_id' => $layanan2->layanan_id,
                'berat_jumlah' => 3.0,
                'total_biaya' => 42000,
                'tgl_masuk' => '2026-11-01',
                'tgl_selesai' => '2026-11-01',
                'status' => 'Selesai',
                'status_pembayaran' => 'Lunas',
                'catatan' => 'Layanan express 6 jam, diantar ke lobi apartemen.',
            ],
            [
                'kode_transaksi' => 'TRX-20261102-003',
                'pelanggan_id' => $pelanggan3->pelanggan_id,
                'layanan_id' => $layanan4->layanan_id,
                'berat_jumlah' => 2.0,
                'total_biaya' => 60000,
                'tgl_masuk' => '2026-11-02',
                'tgl_selesai' => '2026-11-04',
                'status' => 'Baru',
                'status_pembayaran' => 'Belum Lunas',
                'catatan' => 'Bedcover tebal king size motif bunga.',
            ],
            [
                'kode_transaksi' => 'TRX-20261102-004',
                'pelanggan_id' => $pelanggan4->pelanggan_id,
                'layanan_id' => $layanan3->layanan_id,
                'berat_jumlah' => 5.0,
                'total_biaya' => 25000,
                'tgl_masuk' => '2026-11-02',
                'tgl_selesai' => '2026-11-03',
                'status' => 'Diproses',
                'status_pembayaran' => 'Lunas',
                'catatan' => 'Setrika uap halus untuk pakaian pesta.',
            ],
            [
                'kode_transaksi' => 'TRX-20261028-005',
                'pelanggan_id' => $pelanggan5->pelanggan_id,
                'layanan_id' => $layanan5->layanan_id,
                'berat_jumlah' => 1.0,
                'total_biaya' => 45000,
                'tgl_masuk' => '2026-10-28',
                'tgl_selesai' => '2026-10-30',
                'status' => 'Diambil',
                'status_pembayaran' => 'Lunas',
                'catatan' => 'Dry cleaning jas wool warna navy.',
            ],
        ];

        foreach ($transaksiData as $data) {
            Transaksi::firstOrCreate(
                ['kode_transaksi' => $data['kode_transaksi']],
                $data
            );
        }
    }
}
