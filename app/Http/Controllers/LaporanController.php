<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukan = Simpanan::sum('jumlah');
        $pengeluaran = Pinjaman::where('status', 'disetujui')->sum('jumlah');
        $saldoBersih = $pemasukan - $pengeluaran;
        return view('admin.laporan-keuangan', compact('pemasukan', 'pengeluaran', 'saldoBersih'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
