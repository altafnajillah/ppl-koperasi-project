<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biodata>
 */
class BiodataFactory extends Factory
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
            'alamat' => fake()->address(),
            'no_hp' => fake()->phoneNumber(),
            'nik' => fake()->unique()->numerify('################'),
            // 'ktp' => 'ktp_images/' . fake()->uuid() . '.jpg',
            'accepted_at'=> fake()->randomElement([now(), null]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
