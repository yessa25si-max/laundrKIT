<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Barang>
 */
class BarangFactory extends Factory
{
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_barang' => 'BRG-'.fake()->unique()->numerify('###'),
            'nama_barang' => fake()->words(3, true),
            'kategori' => fake()->randomElement(['Deterjen & Sabun', 'Pewangi & Softener', 'Plastik & Kemasan', 'Peralatan & Hanger']),
            'stok' => fake()->numberBetween(0, 100),
            'satuan' => fake()->randomElement(['Liter', 'Pack', 'Lusin', 'Pcs', 'Botol']),
            'harga_beli' => fake()->numberBetween(5000, 100000),
            'status' => fake()->randomElement(['Tersedia', 'Menipis', 'Habis']),
        ];
    }
}
