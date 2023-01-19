<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratKeluar>
 */
class SuratKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomor' => fake()->regexify('[0-9]{4}[A-Z]{3}[0-9]{2}[0-9]{4}'),
            'tanggal' => fake()->dateTimeBetween('-3 years', 'now'),
            'kepada' => fake()->name(),
            'perihal' => fake()->sentence(),
            'isi' => fake()->sentence(5),
            'pegawai_id' => fake()->numberBetween(1, 30)
        ];
    }
}
