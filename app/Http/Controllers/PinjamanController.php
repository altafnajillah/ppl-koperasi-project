<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjaman = Pinjaman::where('id_anggota', $anggota->id)
                            ->select('id', 'jumlah', 'tenor', 'status')
                            ->get();

        return view('pinjaman.index', compact('pinjaman', 'anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Biodata::all();
        return view('pinjaman.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_anggota' => 'required|integer|exists:anggotas,id', 
            'jumlah' => 'required|numeric|min:0',
            'tenor' => 'required|integer|max:2', // tenor dalam bulan
        ]);

        Pinjaman::create($validatedData);

        return redirect('/pinjaman')->with('success', 'Pinjaman berhasil diajukan!');
    }


// Setujui pinjaman
    public function approve(Pinjaman $pinjaman)
    {
        $pinjaman->status = 'disetujui';
        $pinjaman->save();

        return redirect()->back()->with('success', 'Pinjaman berhasil disetujui.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }
}
