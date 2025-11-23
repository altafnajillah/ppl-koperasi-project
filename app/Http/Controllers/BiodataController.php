<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    // Menampilkan form tambah biodata baru
    public function index()
    {
        $user = Auth::user();
        $biodata = Auth::user()->biodata()->first();

        // return $user . $biodata;
        return view('anggota.biodata.profil', ['user' => $user, 'biodata' => $biodata]);
    }

    // Menyimpan data biodata yang baru dimasukkan
    private function handleFileUpload(Request $request, $fieldName, $currentFilePath = null)
    {
        if ($request->hasFile($fieldName)) {
            // 1. Hapus file lama jika ada
            if ($currentFilePath && Storage::disk('public')->exists($currentFilePath)) {
                Storage::disk('public')->delete($currentFilePath);
            }

            // 2. Simpan file baru
            // Folder disesuaikan dengan fieldName
            $folder = $fieldName === 'avatar' ? 'avatars' : 'ktp';

            // Simpan dan dapatkan path-nya
            // Fungsi store() akan menyimpan di storage/app/public/[folder] dan mengembalikan path
            return $request->file($fieldName)->store($folder, 'public');
        }

        // Jika tidak ada file baru diunggah, kembalikan path lama
        return $currentFilePath;
    }

    // ===================================================================
    // CREATE (STORE)
    // ===================================================================
    public function store(Request $request)
    {
        $user = Auth::user();

        // Tambahkan validasi untuk gambar (opsional atau required)
        $validated = $request->validate([
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'nik' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg', //
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // Inisialisasi path gambar
        $avatarPath = null;
        $ktpPath = null;

        // Kelola unggahan Avatar dan KTP (currentFilePath di sini null karena ini adalah operasi CREATE)
        $avatarPath = $this->handleFileUpload($request, 'avatar');
        $ktpPath = $this->handleFileUpload($request, 'ktp');

        Biodata::create([
            'user_id' => $user->id,
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'nik' => $validated['nik'],
            'ktp' => $ktpPath,       // Simpan path gambar
        ]);

        $user->update([
            'avatar' => $avatarPath,
        ]);

        Notifikasi::create([
            'user_id' => $user->id,
            'pesan' => 'Biodata Anda telah Diajukan.',
            'dibaca' => false,
            'tanggal' => now(),
        ]);

        return redirect()->route('anggota.biodata')->with('success', 'Data berhasil ditambahkan');
    }

    // ===================================================================
    // UPDATE
    // ===================================================================
    public function update(Request $request) // Tidak menggunakan Route Model Binding
    {
        $user = Auth::user();

        // Cari biodata yang akan diupdate
        $biodata = Biodata::where('user_id', $user->id)->firstOrFail();

        // Tambahkan validasi untuk gambar (nullable karena update)
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'alamat' => 'required|string|max:150',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'nik' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // --- Kelola Unggahan Gambar (Avatar) ---
        // handleFileUpload akan menghapus file lama jika ada file baru diupload
        $avatarPath = $this->handleFileUpload($request, 'avatar', $biodata->avatar);

        // --- Kelola Unggahan Gambar (KTP) ---
        $ktpPath = $this->handleFileUpload($request, 'ktp', $biodata->ktp);

        // Update data User
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'avatar' => $avatarPath, // Simpan path baru/lama
        ]);

        // Update data Biodata
        $biodata->update([
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'nik' => $validated['nik'],
            'ktp' => $ktpPath,       // Simpan path baru/lama
        ]);

        return redirect()->route('anggota.biodata')->with('success', 'Data berhasil diperbaharui');
    }

    // ===================================================================
    // DELETE (Untuk menghapus gambar, meskipun tidak diminta, ini penting)
    // ===================================================================
    public function destroy(Biodata $biodata)
    {
        // Pengecekan otorisasi (opsional, tergantung logic Anda)
        if ($biodata->user_id !== Auth::id()) {
            return redirect()->route('anggota.biodata')->with('error', 'Akses ditolak.');
        }

        // Hapus file avatar lama jika ada
        if ($biodata->avatar && Storage::disk('public')->exists($biodata->avatar)) {
            Storage::disk('public')->delete($biodata->avatar);
        }

        // Hapus file ktp lama jika ada
        if ($biodata->ktp && Storage::disk('public')->exists($biodata->ktp)) {
            Storage::disk('public')->delete($biodata->ktp);
        }

        // Hapus record dari database
        $biodata->delete();

        return redirect()->route('anggota.biodata')->with('success', 'Biodata berhasil dihapus.');
    }
}
