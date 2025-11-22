<?php

namespace Database\Seeders;

use App\Models\Angsuran;
use App\Models\Biodata;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 1. Jalankan UserSeeder terlebih dahulu
        $this->call(UserSeeder::class);

        // 2. Ambil semua user dengan role 'anggota'
        $anggotas = User::where('role', 'anggota')->get();

        // 3. Loop setiap anggota untuk membuat data terkait
        foreach ($anggotas as $anggota) {
            // Membuat 1 Biodata untuk setiap anggota
            Biodata::factory()->create(['user_id' => $anggota->id]);

            // Membuat 2-5 Notifikasi untuk setiap anggota
            Notifikasi::factory(rand(2, 5))->create(['user_id' => $anggota->id]);

            // Membuat 1-3 Laporan untuk setiap anggota
            Laporan::factory(rand(1, 3))->create(['user_id' => $anggota->id]);

            // Membuat simpanan pokok (1 kali) dan wajib (beberapa kali)
            Simpanan::factory()->create([
                'user_id' => $anggota->id,
                'jenis' => 'pokok',
                'jumlah' => 500000, // Simpanan pokok tetap
                'tanggal' => $anggota->created_at,
            ]);
            Simpanan::factory(rand(5, 12))->create([
                'user_id' => $anggota->id,
                'jenis' => 'wajib',
                'jumlah' => 100000, // Simpanan wajib tetap
            ]);
            // Membuat beberapa simpanan sukarela
            Simpanan::factory(rand(2, 10))->create([
                'user_id' => $anggota->id,
                'jenis' => 'sukarela',
            ]);

            // Membuat 0-2 Pinjaman untuk setiap anggota
            // Pinjaman::factory(rand(0, 2))->create([
            //     'user_id' => $anggota->id,
            // ])->each(function ($pinjaman) {
            //     // Jika pinjaman disetujui, buat data angsurannya
            //     if ($pinjaman->status == 'disetujui') {
            //         $jumlah_angsuran = $pinjaman->jumlah / $pinjaman->tenor;
            //         // Membuat beberapa data angsuran (tidak harus lunas)
            //         $sudah_bayar = rand(1, $pinjaman->tenor);
            //         for ($i = 1; $i <= $sudah_bayar; $i++) {
            //             Angsuran::factory()->create([
            //                 'pinjaman_id' => $pinjaman->id,
            //                 'jumlah' => $jumlah_angsuran,
            //                 'tanggal' => \Carbon\Carbon::parse($pinjaman->tanggal)->addMonths($i),
            //             ]);
            //         }
            //     }
            // });
        }
    }
}
