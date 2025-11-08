<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $unverifiedUser = User::with('biodata')
            ->where('role', 'anggota')
            ->whereRelation('biodata', 'accepted_at', null)
            ->count();

        $newPeminjamans = Pinjaman::where('status', 'menunggu')->count();

        $pinjamanBeredar = Pinjaman::where('status', 'disetujui')->sum('jumlah');

        $totalSimpanan = Simpanan::sum('jumlah');

        return view('petugas.dashboard', [
            'user' => $user,
            'unverifiedUser' => $unverifiedUser,
            'newPeminjamans' => $newPeminjamans,
            'pinjamanBeredar' => $pinjamanBeredar,
            'totalSimpanan' => $totalSimpanan,
        ]);
    }
}
