<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Http\Request;

class ManajemenSimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('user')->get()->sortByDesc('tanggal');
        return view('admin.simpanan.simpanan', compact('simpanans'));
    }

    public function create()
    {
        $users = User::where('role', 'anggota')->get();
        return view('admin.simpanan.tambah-simpanan', compact('users'));
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

    public function edit($id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $users = User::where('role', 'anggota')->get();

        return view('admin.simpanan.edit-simpanan', compact('simpanan', 'users'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => ['required'],
            'jenis'   => ['required'],
            'jumlah'  => ['required', 'numeric'],
            'tanggal' => ['required'],
        ]);

        $simpanan = Simpanan::findOrFail($id);

        $simpanan->update([
            'user_id' => $request->user_id,
            'jenis'   => $request->jenis,
            'jumlah'  => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function simpananPerAnggota(Request $request)
    {
        $query = User::query()->whereHas('simpanan');

        // Fitur Search
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        // Ambil semua data (get) dengan agregasi penjumlahan
        $data = $query->withSum(['simpanan as wajib' => function ($q) {
            $q->where('jenis', 'wajib');
        }], 'jumlah')
            ->withSum(['simpanan as pokok' => function ($q) {
                $q->where('jenis', 'pokok');
            }], 'jumlah')
            ->withSum(['simpanan as sukarela' => function ($q) {
                $q->where('jenis', 'sukarela');
            }], 'jumlah')
            ->withMax('simpanan as tanggal_terakhir', 'tanggal')
            ->get(); // <--- Diganti dari paginate() menjadi get()

        return view('admin.simpanan.simpanan-per-anggota', compact('data'));
    }
}
