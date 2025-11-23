<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'jumlah_pinjaman'=>'required|numeric|min:0.01|max:9999999999.99',
        'tenor'=>'required|integer|min:1|max:99',
    ]);

    $bungaDefault = 0.05; // pastikan ada nilai default

    Pinjaman::create([
        'id_anggota'=>Auth::id(),
        'jumlah_pinjaman'=>$request->jumlah_pinjaman,
        'tenor'=>$request->tenor,
        'status'=>'menunggu',
        'tanggal_pengajuan'=>now(),
        'bunga'=>$bungaDefault
    ]);

    return redirect()->route('anggota.pinjaman')
        ->with('success', 'Pengajuan pinjaman anda berhasil dikirim pada '.now()->format('d M Y').' dan sedang menunggu persetujuan');
}

    //setujui pinjaman itu disetujui oleh admindan petugas jadi kodenya ditulis di bagian admincontrooler


    //Lihat Simpanan
    public function index()
    {
        $anggotaId = Auth::id();
        $riwayatPinjaman=Pinjaman::where('id_anggota', $anggotaId)->orderByDesc('tanggal_pengajuan')->get();
        return view('pinjaman.index',['pinjamans'=>$riwayatPinjaman]);
    }

}
