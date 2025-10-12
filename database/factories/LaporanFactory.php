<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'jenis' => fake()->randomElement(['simpan', 'pinjam', 'angsur']),
            'file' => 'laporan/' . fake()->uuid() . '.pdf',
            'tanggal' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
