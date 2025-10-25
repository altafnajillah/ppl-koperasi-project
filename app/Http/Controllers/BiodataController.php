<?php
namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    // Menampilkan form tambah biodata baru
    public function create()
    {
        return view('anggota.biodata.create');
    }

    // Menyimpan data biodata yang baru dimasukkan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:150',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'nik' => 'required|string|max:20',
        ]);

        $biodata = Biodata::create($validated);

        // Setelah data disimpan, redirect ke tampilan detail biodata yang baru dibuat
        return redirect()->route('biodata.show', $biodata->id)->with('success', 'Data berhasil ditambahkan');
    }

    // Menampilkan detail biodata berdasarkan ID
    public function show(Biodata $biodata)
    {
        return view('biodata.show', compact('biodata'));
    }

    // Menampilkan form edit biodata
    public function edit(Biodata $biodata)
    {
        return view('biodata.edit', compact('biodata'));
    }

    // Memperbarui data biodata yang sudah ada
    public function update(Request $request, Biodata $biodata)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:150',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'nik' => 'required|string|max:20',
        ]);

        $biodata->update($validated);

        // Setelah update, redirect ke detail biodata yang diperbaharui
        return redirect()->route('biodata.show', $biodata->id)->with('success', 'Data berhasil diperbaharui');
    }

    // Menghapus biodata berdasarkan ID
    public function destroy(Biodata $biodata)
    {
        $biodata->delete();

        // Setelah dihapus, redirect ke form tambah biodata baru
        return redirect()->route('biodata.create')->with('success', 'Data berhasil dihapus');
    }
}
