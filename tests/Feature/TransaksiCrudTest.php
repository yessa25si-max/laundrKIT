<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiCrudTest extends TestCase
{
    use RefreshDatabase;

    private Pelanggan $pelanggan;

    private Layanan $layanan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pelanggan = Pelanggan::create([
            'first_name' => 'Aditya',
            'last_name' => 'Pratama',
            'email' => 'aditya@example.com',
            'phone' => '081299887766',
        ]);

        $this->layanan = Layanan::create([
            'kode_layanan' => 'LYN-TEST',
            'nama_layanan' => 'Cuci Kiloan Reguler',
            'kategori' => 'Cuci Kiloan',
            'harga' => 8000,
            'satuan' => 'Kg',
            'durasi_jam' => 24,
            'deskripsi' => 'Layanan uji coba',
        ]);
    }

    public function test_transaksi_index_can_be_rendered(): void
    {
        Transaksi::create([
            'kode_transaksi' => 'TRX-TEST-001',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 3.0,
            'total_biaya' => 24000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Diproses',
            'status_pembayaran' => 'Lunas',
        ]);

        $response = $this->get(route('transaksi.index'));

        $response->assertStatus(200);
        $response->assertSee('TRX-TEST-001');
        $response->assertSee('Aditya');
        $response->assertSee('Cuci Kiloan Reguler');
        $response->assertSee('Eloquent ORM');
    }

    public function test_transaksi_create_form_renders_with_related_data(): void
    {
        $response = $this->get(route('transaksi.create'));

        $response->assertStatus(200);
        $response->assertSee('Aditya Pratama');
        $response->assertSee('Cuci Kiloan Reguler');
    }

    public function test_transaksi_store_saves_data_using_eloquent(): void
    {
        $payload = [
            'kode_transaksi' => 'TRX-NEW-999',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 4.5,
            'total_biaya' => 36000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Baru',
            'status_pembayaran' => 'Belum Lunas',
            'catatan' => 'Uji coba simpan transaksi',
        ];

        $response = $this->post(route('transaksi.store'), $payload);

        $response->assertRedirect(route('transaksi.index'));
        $this->assertDatabaseHas('transaksi', [
            'kode_transaksi' => 'TRX-NEW-999',
            'total_biaya' => 36000,
            'status' => 'Baru',
        ]);
    }

    public function test_transaksi_show_displays_order_and_customer_details(): void
    {
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-SHOW-001',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 2.0,
            'total_biaya' => 16000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Selesai',
            'status_pembayaran' => 'Lunas',
        ]);

        $response = $this->get(route('transaksi.show', $transaksi->transaksi_id));

        $response->assertStatus(200);
        $response->assertSee('TRX-SHOW-001');
        $response->assertSee('Aditya Pratama');
        $response->assertSee('Cuci Kiloan Reguler');
    }

    public function test_transaksi_update_modifies_record(): void
    {
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-EDIT-001',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 2.0,
            'total_biaya' => 16000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Baru',
            'status_pembayaran' => 'Belum Lunas',
        ]);

        $response = $this->put(route('transaksi.update', $transaksi->transaksi_id), [
            'kode_transaksi' => 'TRX-EDIT-001',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 2.5,
            'total_biaya' => 20000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Selesai',
            'status_pembayaran' => 'Lunas',
        ]);

        $response->assertRedirect(route('transaksi.index'));
        $this->assertDatabaseHas('transaksi', [
            'transaksi_id' => $transaksi->transaksi_id,
            'status' => 'Selesai',
            'status_pembayaran' => 'Lunas',
            'total_biaya' => 20000,
        ]);
    }

    public function test_transaksi_destroy_deletes_record(): void
    {
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-DEL-001',
            'pelanggan_id' => $this->pelanggan->pelanggan_id,
            'layanan_id' => $this->layanan->layanan_id,
            'berat_jumlah' => 1.0,
            'total_biaya' => 8000,
            'tgl_masuk' => '2026-11-02',
            'status' => 'Diambil',
            'status_pembayaran' => 'Lunas',
        ]);

        $response = $this->delete(route('transaksi.destroy', $transaksi->transaksi_id));

        $response->assertRedirect(route('transaksi.index'));
        $this->assertDatabaseMissing('transaksi', [
            'transaksi_id' => $transaksi->transaksi_id,
        ]);
    }
}
