<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Angsuran>
 */
class AngsuranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pinjaman_id' => null, // Akan di-set dari seeder
            'jumlah' => 0,
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_paid' => $this->faker->boolean(),
        ];
    }
}
