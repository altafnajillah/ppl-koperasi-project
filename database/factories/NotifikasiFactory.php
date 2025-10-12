<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notifikasi>
 */
class NotifikasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // Akan di-set dari seeder
            'pesan' => fake()->sentence(6),
            'dibaca' => fake()->boolean(50),
            'tanggal' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
