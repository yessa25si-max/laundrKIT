<?php

namespace Database\Factories;

use App\Models\Layanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Layanan>
 */
class LayananFactory extends Factory
{
    protected $model = Layanan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_layanan' => 'LYN-'.fake()->unique()->numerify('###'),
            'nama_layanan' => fake()->words(3, true),
            'kategori' => fake()->randomElement(['Cuci Kiloan', 'Cuci Satuan', 'Dry Clean', 'Setrika Saja']),
            'harga' => fake()->numberBetween(5000, 50000),
            'satuan' => fake()->randomElement(['Kg', 'Pcs']),
            'durasi_jam' => fake()->randomElement([6, 12, 24, 48, 72]),
            'deskripsi' => fake()->optional()->sentence(),
        ];
    }
}
