<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Notifikasi;
use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenPinjamanController extends Controller
{
    public function index()
    {
        $pengajuanPinjaman = Pinjaman::where('status', 'menunggu')->orderByDesc('tanggal')->get();
        $pinjamanAktif = Pinjaman::where('status', 'disetujui')->get();
        return view('petugas.pinjaman.pinjaman', compact('pinjamanAktif', 'pengajuanPinjaman'));
    }

    public function create()
    {
        $users = User::where('role', 'anggota')->get();

        return view('petugas.pinjaman.tambah-pinjaman', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alasan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:100000',
            'tenor' => 'required|integer|min:1|max:24',
            'jaminan' => 'file|mimes:jpg,jpeg,png,pdf',
        ]); 
        
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
        $pinjaman->user_id = $request->input('user_id');
        $pinjaman->alasan = $request->input('alasan');
        $pinjaman->jumlah = $request->input('jumlah');
        $pinjaman->tenor = $request->input('tenor');
        $pinjaman->bunga = 2;
        $pinjaman->jaminan = $jaminanPath;
        $pinjaman->tanggal = now();
        $pinjaman->save();

        return back()->with('success', 'Pengajuan pinjaman berhasil diajukan.');
    }

    public function approve($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->status = 'disetujui';
        
        for ($i = 1; $i <= $pinjaman->tenor; $i++) {
            Angsuran::create([
                'pinjaman_id' => $pinjaman->id,
                'jumlah' => ($pinjaman->jumlah / $pinjaman->tenor), //+ (($pinjaman->jumlah * $pinjaman->bunga) / $pinjaman->tenor),
                'tanggal' => now()->addMonths($i),
                'is_paid' => false,
            ]);
        }

        $pinjaman->save();
        
        Notifikasi::create([
            'user_id' => $pinjaman->user_id,
            'pesan' => 'Pengajuan pinjaman Anda telah disetujui.',
            'dibaca' => false,
            'tanggal' => now(),
        ]);

        return back()->with('success', 'Pengajuan pinjaman berhasil disetujui.');
    }
}
