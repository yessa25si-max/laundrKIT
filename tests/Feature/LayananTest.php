<?php

namespace Tests\Feature;

use App\Models\Layanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayananTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_layanan_index_page(): void
    {
        $response = $this->get(route('layanan.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Paket');
    }

    public function test_can_display_layanan_create_page(): void
    {
        $response = $this->get(route('layanan.create'));
        $response->assertStatus(200);
        $response->assertSee('Form Tambah Layanan Laundry');
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('layanan.store'), []);
        $response->assertSessionHasErrors(['kode_layanan', 'nama_layanan', 'kategori', 'harga', 'satuan', 'durasi_jam']);
    }

    public function test_store_saves_layanan_and_redirects_with_flash(): void
    {
        $kode = 'TEST-'.time();
        $payload = [
            'kode_layanan' => $kode,
            'nama_layanan' => 'Cuci Boneka Super',
            'kategori' => 'Cuci Satuan',
            'harga' => 20000,
            'satuan' => 'Pcs',
            'durasi_jam' => 24,
            'deskripsi' => 'Cuci boneka higienis.',
        ];

        $response = $this->post(route('layanan.store'), $payload);

        $response->assertRedirect(route('layanan.index'));
        $response->assertSessionHas('success', 'Data Layanan Cuci baru berhasil ditambahkan!');

        $this->assertDatabaseHas('layanan', [
            'kode_layanan' => $kode,
        ]);
    }

    public function test_can_update_layanan(): void
    {
        $layanan = Layanan::create([
            'kode_layanan' => 'LYN-999',
            'nama_layanan' => 'Cuci Helm',
            'kategori' => 'Cuci Satuan',
            'harga' => 15000,
            'satuan' => 'Pcs',
            'durasi_jam' => 12,
        ]);

        $response = $this->put(route('layanan.update', $layanan->layanan_id), [
            'kode_layanan' => 'LYN-999',
            'nama_layanan' => 'Cuci Helm Full Face',
            'kategori' => 'Cuci Satuan',
            'harga' => 18000,
            'satuan' => 'Pcs',
            'durasi_jam' => 12,
        ]);

        $response->assertRedirect(route('layanan.index'));
        $response->assertSessionHas('success', 'Data Layanan Cuci berhasil diperbarui!');
    }

    public function test_can_delete_layanan(): void
    {
        $layanan = Layanan::create([
            'kode_layanan' => 'LYN-DELETE',
            'nama_layanan' => 'Layanan Hapus',
            'kategori' => 'Cuci Kiloan',
            'harga' => 5000,
            'satuan' => 'Kg',
            'durasi_jam' => 24,
        ]);

        $response = $this->delete(route('layanan.destroy', $layanan->layanan_id));

        $response->assertRedirect(route('layanan.index'));
        $response->assertSessionHas('success', 'Data Layanan Cuci berhasil dihapus!');
        $this->assertDatabaseMissing('layanan', ['layanan_id' => $layanan->layanan_id]);
    }
}
