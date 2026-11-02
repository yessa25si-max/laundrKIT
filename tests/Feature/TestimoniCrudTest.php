<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TestimoniCrudTest extends TestCase
{
    use RefreshDatabase;

    private Pelanggan $pelanggan;

    private Layanan $layanan;

    private Transaksi $transaksi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pelanggan = Pelanggan::create([
            'first_name' => 'Citra',
            'last_name' => 'Lestari',
            'email' => 'citra@example.com',
            'phone' => '085711223344',
        ]);

        $this->layanan = Layanan::create([
            'kode_layanan' => 'LYN-REV',
            'nama_layanan' => 'Cuci Bedcover Lembut',
            'kategori' => 'Cuci Satuan',
            'harga' => 25000,
            'satuan' => 'Pcs',
            'durasi_jam' => 24,
        ]);

        $this->transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-TEST-REV',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 1.0,
            'total_biaya' => 25000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Selesai',
            'status_pembayaran' => 'Lunas',
        ]);
    }

    public function test_testimoni_index_renders_with_query_builder_data(): void
    {
        DB::table('testimoni')->insert([
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'transaksi_id' => $this->transaksi->transaksi_id,
            'rating' => 5,
            'komentar' => 'Sangat wangi dan bersih luar biasa!',
            'status_tampil' => 'Tampilkan',
            'tgl_ulasan' => '2026-11-02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->get(route('testimoni.index'));

        $response->assertStatus(200);
        $response->assertSee('Citra');
        $response->assertSee('Cuci Bedcover Lembut');
        $response->assertSee('Query Builder (DB::table)');
    }

    public function test_testimoni_create_renders_form(): void
    {
        $response = $this->get(route('testimoni.create'));

        $response->assertStatus(200);
        $response->assertSee('Citra Lestari');
        $response->assertSee('Cuci Bedcover Lembut');
    }

    public function test_testimoni_store_inserts_via_query_builder(): void
    {
        $payload = [
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'transaksi_id' => $this->transaksi->transaksi_id,
            'rating' => 5,
            'komentar' => 'Pelayanan cepat dan baju wangi tahan lama.',
            'status_tampil' => 'Tampilkan',
            'tgl_ulasan' => '2026-11-02',
        ];

        $response = $this->post(route('testimoni.store'), $payload);

        $response->assertRedirect(route('testimoni.index'));
        $this->assertDatabaseHas('testimoni', [
            'komentar' => 'Pelayanan cepat dan baju wangi tahan lama.',
            'rating' => 5,
            'status_tampil' => 'Tampilkan',
        ]);
    }

    public function test_testimoni_show_displays_joined_data(): void
    {
        $id = DB::table('testimoni')->insertGetId([
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'transaksi_id' => $this->transaksi->transaksi_id,
            'rating' => 4,
            'komentar' => 'Mantap dan memuaskan.',
            'status_tampil' => 'Tampilkan',
            'tgl_ulasan' => '2026-11-02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->get(route('testimoni.show', $id));

        $response->assertStatus(200);
        $response->assertSee('Mantap dan memuaskan.');
        $response->assertSee('Citra Lestari');
    }

    public function test_testimoni_update_modifies_data_via_query_builder(): void
    {
        $id = DB::table('testimoni')->insertGetId([
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'transaksi_id' => $this->transaksi->transaksi_id,
            'rating' => 3,
            'komentar' => 'Ulasan sebelum diedit',
            'status_tampil' => 'Sembunyikan',
            'tgl_ulasan' => '2026-11-02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->put(route('testimoni.update', $id), [
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'transaksi_id' => $this->transaksi->transaksi_id,
            'rating' => 5,
            'komentar' => 'Ulasan sudah diperbaiki sangat bagus',
            'status_tampil' => 'Tampilkan',
            'tgl_ulasan' => '2026-11-02',
        ]);

        $response->assertRedirect(route('testimoni.index'));
        $this->assertDatabaseHas('testimoni', [
            'testimoni_id' => $id,
            'rating' => 5,
            'komentar' => 'Ulasan sudah diperbaiki sangat bagus',
            'status_tampil' => 'Tampilkan',
        ]);
    }

    public function test_testimoni_destroy_deletes_record_via_query_builder(): void
    {
        $id = DB::table('testimoni')->insertGetId([
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'rating' => 1,
            'komentar' => 'Ulasan spam untuk dihapus',
            'status_tampil' => 'Sembunyikan',
            'tgl_ulasan' => '2026-11-02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->delete(route('testimoni.destroy', $id));

        $response->assertRedirect(route('testimoni.index'));
        $this->assertDatabaseMissing('testimoni', [
            'testimoni_id' => $id,
        ]);
    }
}
