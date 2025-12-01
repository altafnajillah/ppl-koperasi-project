<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Http\Request;

class ManajemenPinjamanController extends Controller
{
    public function index(Request $request)
    {
        $pengajuanPinjaman = Pinjaman::with('user')
            ->where('status', 'menunggu')
            ->when($request->search_pending, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->get();

        $pinjamanAktif = Pinjaman::with('user')
            ->where('status', 'disetujui')
            ->when($request->search_active, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->when($request->date_from && $request->date_to, function ($query) use ($request) {
                $query->whereBetween('tanggal', [$request->date_from, $request->date_to]);
            })
            ->get();

        return view('admin.pinjaman.pinjaman', compact('pinjamanAktif', 'pengajuanPinjaman'));
    }

    public function create()
    {
        $users = User::where('role', 'anggota')->get();

        return view('admin.pinjaman.tambah-pinjaman', compact('users'));
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

        $pinjaman = new \App\Models\Pinjaman;
        $jaminanPath = null;
        if ($request->jumlah > 10000000) {
            if ($request->hasFile('jaminan')) {
                // code...
                $filename = time().'_'.$request->file('jaminan')->getClientOriginalName();

                $request->file('jaminan')->move(public_path('jaminan'), $filename);

                $jaminanPath = 'jaminan/'.$filename;
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
}
