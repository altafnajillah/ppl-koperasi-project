<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::where('role', 'anggota')->get();
        $totalAnggota = $anggota->count();
        return view('petugas.anggota.manajemen-anggota', compact('anggota', 'totalAnggota'));
    }

    public function create()
    {
        return view('petugas.anggota.tambah-anggota');
    }

    public function store(Request $request)
    {
        // 🔹 1. Validasi input
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed', 
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.', 
            ],
        );

        // 🔹 2. Simpan data ke tabel users
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'anggota',
        ]);

        // 🔹 3. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = User::findOrFail($id);
        return view('petugas.anggota.edit-anggota', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
            ],
        );

        $anggota = User::findOrFail($id);
        $anggota->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = User::findOrFail($id);
        $anggota->delete();

        return redirect()->back()->with('success', 'Anggota berhasil dihapus!');
    }

    public function show($id)
    {
        $anggota = User::findOrFail($id);
        return view('petugas.anggota.profil-anggota', compact('anggota'));
    }
}
