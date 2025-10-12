<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat User Admin
        User::create([
            'name' => 'Admin Koperasi',
            'email' => 'admin@koperasi.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Membuat User Petugas
        User::create([
            'name' => 'Petugas Koperasi',
            'email' => 'petugas@koperasi.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);

        // Membuat 1 User Anggota (untuk testing)
        User::create([
            'name' => 'Anggota Koperasi',
            'email' => 'anggota@koperasi.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'email_verified_at' => now(),
        ]);

        // Membuat 50 User Anggota dengan data acak
        User::factory(20)->create();
    }
}
