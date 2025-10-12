<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biodata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:150',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'nik' => 'required|string|max:20',
        ]);

        // Simpan data
        Biodata::create($validatedData);

        return redirect('/biodata')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Biodata $biodata)
    {
         return view('biodata.show', compact('biodata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biodata $biodata)
    {
         return view('biodata.edit', compact('biodata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biodata $biodata)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:150',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'nik' => 'required|string|max:20',
        ]);

        $biodata->update($validatedData);
        return redirect('/biodata')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        $biodata->delete();
        return redirect('/biodata')->with('success', 'Data berhasil dihapus');
    }
}
