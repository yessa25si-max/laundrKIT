<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds using Query Builder (DB::table).
     */
    public function run(): void
    {
        $pelanggan1 = DB::table('pelanggan')->orderBy('pelanggan_id')->first();
        $pelanggan2 = DB::table('pelanggan')->orderBy('pelanggan_id')->skip(1)->first() ?? $pelanggan1;
        $pelanggan3 = DB::table('pelanggan')->orderBy('pelanggan_id')->skip(2)->first() ?? $pelanggan1;
        $pelanggan4 = DB::table('pelanggan')->orderBy('pelanggan_id')->skip(3)->first() ?? $pelanggan1;

        $layanan1 = DB::table('layanan')->orderBy('layanan_id')->first();
        $layanan2 = DB::table('layanan')->orderBy('layanan_id')->skip(1)->first() ?? $layanan1;
        $layanan3 = DB::table('layanan')->orderBy('layanan_id')->skip(2)->first() ?? $layanan1;

        $transaksi1 = DB::table('transaksi')->orderBy('transaksi_id')->first();
        $transaksi2 = DB::table('transaksi')->orderBy('transaksi_id')->skip(1)->first();

        if (! $pelanggan1 || ! $layanan1) {
            return;
        }

        // Hapus data lama jika ada agar tidak duplikat saat seeding ulang
        DB::table('testimoni')->truncate();

        DB::table('testimoni')->insert([
            [
                'pelanggan_id' => $pelanggan1->pelanggan_id,
                'layanan_id' => $layanan1->layanan_id,
                'transaksi_id' => $transaksi1 ? $transaksi1->transaksi_id : null,
                'rating' => 5,
                'komentar' => 'Hasil cuci sangat wangi dan rapi banget! Baju kerja saya licin sempurna tanpa bekas lipatan kaku. Pelayanan antar jemputnya juga on time.',
                'status_tampil' => 'Tampilkan',
                'tgl_ulasan' => '2026-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => $pelanggan2->pelanggan_id,
                'layanan_id' => $layanan2->layanan_id,
                'transaksi_id' => $transaksi2 ? $transaksi2->transaksi_id : null,
                'rating' => 5,
                'komentar' => 'Layanan express 6 jam benar-benar menyelamatkan acara formal saya! Pagi dicuci, siang sudah siap dipakai dan tetap sangat wangi.',
                'status_tampil' => 'Tampilkan',
                'tgl_ulasan' => '2026-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => $pelanggan3->pelanggan_id,
                'layanan_id' => $layanan3->layanan_id,
                'transaksi_id' => null,
                'rating' => 5,
                'komentar' => 'Paket setrikanya rapi luar biasa. Packaging plastiknya tebal dan elegan, wangi parfum laundry-nya tahan sampai berminggu-minggu di lemari.',
                'status_tampil' => 'Tampilkan',
                'tgl_ulasan' => '2026-10-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => $pelanggan4->pelanggan_id,
                'layanan_id' => $layanan1->layanan_id,
                'transaksi_id' => null,
                'rating' => 4,
                'komentar' => 'Harganya sangat bersahabat untuk kualitas premium. Customer service ramah dan selalu update status cucian lewat website.',
                'status_tampil' => 'Tampilkan',
                'tgl_ulasan' => '2026-10-29',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
