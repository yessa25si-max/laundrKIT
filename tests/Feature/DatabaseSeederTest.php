<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Layanan;
use App\Models\Pelanggan;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_populates_all_tables_correctly(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@laundrkit.com',
        ]);

        $this->assertTrue(Pelanggan::count() >= 5);
        $this->assertTrue(Layanan::count() >= 5);
        $this->assertTrue(Barang::count() >= 5);
    }

    public function test_model_factories_create_valid_instances(): void
    {
        $pelanggan = Pelanggan::factory()->create();
        $layanan = Layanan::factory()->create();
        $barang = Barang::factory()->create();

        $this->assertDatabaseHas('pelanggan', ['pelanggan_id' => $pelanggan->pelanggan_id]);
        $this->assertDatabaseHas('layanan', ['layanan_id' => $layanan->layanan_id]);
        $this->assertDatabaseHas('barang', ['barang_id' => $barang->barang_id]);
    }
}
