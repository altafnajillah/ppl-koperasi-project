<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pinjamans = $user->pinjaman;
        return view('anggota.pinjaman.pinjaman', ['user' => $user, 'pinjamans' => $pinjamans]);
    }

    public function create()
    {
        return view('anggota.pinjaman.tambah-pinjaman');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'alasan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:100000',
            'tenor' => 'required|integer|min:1|max:24',
            'jaminan' => 'file|mimes:jpg,jpeg,png,pdf',
        ]);

        $user = Auth::user();
        $pinjaman = new \App\Models\Pinjaman();
        $jaminanPath = null; 
        if ($request->jumlah > 10000000) {
            if ($request->hasFile('jaminan')) {
                # code...
                $filename = time() . '_' . $request->file('jaminan')->getClientOriginalName();

                $request->file('jaminan')->move(public_path('jaminan'), $filename);

                $jaminanPath = 'jaminan/' . $filename;
            } else {
                $request->validate([
                    'jaminan' => 'required',
                ]);
            }
        }

        // Buat pinjaman baru
        $pinjaman->user_id = $user->id;
        $pinjaman->alasan = $request->input('alasan');
        $pinjaman->jumlah = $request->input('jumlah');
        $pinjaman->tenor = $request->input('tenor');
        $pinjaman->bunga = 5.0;
        $pinjaman->jaminan = $jaminanPath;
        $pinjaman->tanggal = now();
        $pinjaman->save();

        return back()->with('success', 'Pengajuan pinjaman berhasil diajukan.');
    }
}
