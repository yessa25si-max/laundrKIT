<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PelangganTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_pelanggan_index_page(): void
    {
        $response = $this->get(route('pelanggan.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Pelanggan Laundry');
    }

    public function test_can_display_pelanggan_create_page(): void
    {
        $response = $this->get(route('pelanggan.create'));
        $response->assertStatus(200);
        $response->assertSee('Form Tambah Pelanggan');
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('pelanggan.store'), []);
        $response->assertSessionHasErrors(['first_name', 'last_name', 'email']);
    }

    public function test_store_saves_pelanggan_and_redirects_with_flash(): void
    {
        $email = 'testing_'.time().'@laundrkit.com';
        $payload = [
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'email' => $email,
            'phone' => '081234567890',
            'gender' => 'Male',
            'birthday' => '1995-05-20',
        ];

        $response = $this->post(route('pelanggan.store'), $payload);

        $response->assertRedirect(route('pelanggan.index'));
        $response->assertSessionHas('success', 'Data Pelanggan berhasil ditambahkan!');

        $this->assertDatabaseHas('pelanggan', [
            'email' => $email,
        ]);
    }

    public function test_can_update_pelanggan(): void
    {
        $pelanggan = Pelanggan::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->put(route('pelanggan.update', $pelanggan->pelanggan_id), [
            'first_name' => 'John Updated',
            'last_name' => 'Doe Updated',
            'email' => $pelanggan->email,
        ]);

        $response->assertRedirect(route('pelanggan.index'));
        $response->assertSessionHas('success', 'Data Pelanggan berhasil diperbarui!');
    }

    public function test_can_delete_pelanggan(): void
    {
        $pelanggan = Pelanggan::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
        ]);

        $response = $this->delete(route('pelanggan.destroy', $pelanggan->pelanggan_id));

        $response->assertRedirect(route('pelanggan.index'));
        $response->assertSessionHas('success', 'Data Pelanggan berhasil dihapus!');
        $this->assertDatabaseMissing('pelanggan', ['pelanggan_id' => $pelanggan->pelanggan_id]);
    }
}
