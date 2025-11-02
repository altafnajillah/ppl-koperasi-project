<?php
namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    // Menampilkan form tambah biodata baru
public function index()
    {
        $user = Auth::user();
        $biodata = Auth::user()->biodata()->first();
        // return $user . $biodata;
        return view('anggota.biodata.profil', ['user'=> $user, 'biodata' => $biodata]);
    }

    // Menyimpan data biodata yang baru dimasukkan
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            // 'nama' => 'required|string|max:50',
            // 'email' => 'required|email|max:100',
        
            'alamat' => 'required|string|max:150',
            'no_hp' => 'required|string|max:15',
            'nik' => 'required|string|max:20',
        ]);

        // $user::update([
        //     'name' => $validated['nama'],
        //     'email' => $validated['email'],
        // ]);

        Biodata::create([
            'user_id' => $user->id,
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'nik' => $validated['nik'],
        ]);

        return redirect()->route('anggota.biodata')->with('success', 'Data berhasil ditambahkan');
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

        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'alamat' => 'required|string|max:150',

            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'nik' => 'required|string|max:20',
        ]);

        $user::where('id', $user->id)
        ->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $biodata::where('user_id', $user->id)
        ->update([
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'nik' => $validated['nik'],
        ]);

        // Setelah update, redirect ke detail biodata yang diperbaharui
        return redirect()->route('anggota.biodata')->with('success', 'Data berhasil diperbaharui');
    }

    // Menghapus biodata berdasarkan ID
    public function destroy(Biodata $biodata)
    {
        $biodata->delete();

        // Setelah dihapus, redirect ke form tambah biodata baru
        return redirect()->route('biodata.create')->with('success', 'Data berhasil dihapus');
    }
}
