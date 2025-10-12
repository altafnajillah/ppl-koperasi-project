<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Simpanan>
 */
class SimpananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // User ID akan di-set dari seeder
            'user_id' => User::factory(),
            'jenis' => fake()->randomElement(['pokok', 'wajib', 'sukarela']),
            'jumlah' => fake()->randomElement([100000, 200000, 50000, 150000, 250000]),
            'tanggal' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
