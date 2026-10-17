<?php

namespace Tests\Feature;

use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_barang_index_page(): void
    {
        $response = $this->get(route('barang.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Perlengkapan');
    }

    public function test_can_display_barang_create_page(): void
    {
        $response = $this->get(route('barang.create'));
        $response->assertStatus(200);
        $response->assertSee('Form Tambah Perlengkapan Laundry');
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('barang.store'), []);
        $response->assertSessionHasErrors(['kode_barang', 'nama_barang', 'kategori', 'stok', 'satuan', 'harga_beli', 'status']);
    }

    public function test_store_saves_barang_and_redirects_with_flash(): void
    {
        $kode = 'TEST-BRG-'.time();
        $payload = [
            'kode_barang' => $kode,
            'nama_barang' => 'Tag Penanda Baju',
            'kategori' => 'Peralatan & Hanger',
            'stok' => 500,
            'satuan' => 'Pcs',
            'harga_beli' => 50,
            'status' => 'Tersedia',
        ];

        $response = $this->post(route('barang.store'), $payload);

        $response->assertRedirect(route('barang.index'));
        $response->assertSessionHas('success', 'Data Barang / Perlengkapan baru berhasil ditambahkan!');

        $this->assertDatabaseHas('barang', [
            'kode_barang' => $kode,
        ]);
    }

    public function test_can_update_barang(): void
    {
        $barang = Barang::create([
            'kode_barang' => 'BRG-999',
            'nama_barang' => 'Deterjen Bubuk',
            'kategori' => 'Deterjen & Sabun',
            'stok' => 10,
            'satuan' => 'Kg',
            'harga_beli' => 12000,
            'status' => 'Tersedia',
        ]);

        $response = $this->put(route('barang.update', $barang->barang_id), [
            'kode_barang' => 'BRG-999',
            'nama_barang' => 'Deterjen Bubuk Extra Wangi',
            'kategori' => 'Deterjen & Sabun',
            'stok' => 20,
            'satuan' => 'Kg',
            'harga_beli' => 14000,
            'status' => 'Tersedia',
        ]);

        $response->assertRedirect(route('barang.index'));
        $response->assertSessionHas('success', 'Data Barang / Perlengkapan berhasil diperbarui!');
    }

    public function test_can_delete_barang(): void
    {
        $barang = Barang::create([
            'kode_barang' => 'BRG-DEL',
            'nama_barang' => 'Barang Dihapus',
            'kategori' => 'Peralatan & Hanger',
            'stok' => 1,
            'satuan' => 'Pcs',
            'harga_beli' => 1000,
            'status' => 'Habis',
        ]);

        $response = $this->delete(route('barang.destroy', $barang->barang_id));

        $response->assertRedirect(route('barang.index'));
        $response->assertSessionHas('success', 'Data Barang / Perlengkapan berhasil dihapus!');
        $this->assertDatabaseMissing('barang', ['barang_id' => $barang->barang_id]);
    }
}
