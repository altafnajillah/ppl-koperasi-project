<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Biodata $anggota)
    {
        // Ambil semua simpanan milik anggota
        $simpanan = Simpanan::where('id_anggota', $anggota->id)->get();

        return view('simpanan.index', compact('simpanan', 'anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $anggota = Biodata::all(); 
        return view('simpanan.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_anggota' => 'required|integer|exists:anggotas,id',
            'jenis_simpanan' => 'required|in:pokok,wajib,sukarela',
            'jumlah' => 'required|numeric|min:0',
        ]);

        Simpanan::create($validatedData);
        return redirect('/simpanan')->with('success', 'Data simpanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Simpanan $simpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Simpanan $simpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Simpanan $simpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simpanan $simpanan)
    {
        $simpanan->delete();
        return redirect('/simpanan')->with('success', 'Data simpanan berhasil dihapus!');
    }
}
