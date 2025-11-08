<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Http\Request;

class ManajemenSimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('user')->get()->sortByDesc('tanggal');
        return view('petugas.simpanan.simpanan', compact('simpanans'));
    }

    public function create()
    {
        $users = User::where('role', 'anggota')->get();
        return view('petugas.simpanan.tambah-simpanan', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'jenis'   => ['required'],
            'jumlah'  => ['required', 'numeric'],
            'tanggal' => ['required', 'date']
        ]);

        Simpanan::create([
            'user_id' => $request->user_id,
            'jenis'   => $request->jenis,
            'jumlah'  => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Data simpanan berhasil ditambahkan.');
    }
}
