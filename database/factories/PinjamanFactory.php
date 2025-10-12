<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pinjaman>
 */
class PinjamanFactory extends Factory
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
            'jumlah' => fake()->numberBetween(1, 10) * 1000000, // Kelipatan 1 juta
            'tenor' => fake()->randomElement([6, 12, 18, 24]), // dalam bulan
            'status' => fake()->randomElement(['menunggu', 'disetujui', 'ditolak']),
            'jaminan' => 'sertifikat/' . fake()->uuid() . '.pdf',
            'tanggal' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
