<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nik' => fake()->numberBetween(1000000000000000, 9999999999999999),
            'nama' => fake()->name(),
            'tanggal_lahir' => fake()->dateTimeBetween('-65 years', '-15 years'),
            'gender' => fake()->randomElement(['Pria', 'Wanita']),
            'nomor_hp' => fake()->phoneNumber(),
            'email' => fake()->safeEmail()
        ];
    }
}
