<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class ManajemenPinjamanController extends Controller
{
    public function index()
    {
        $pengajuanPinjaman = Pinjaman::where('status', 'menunggu')->get();
        $pinjamanAktif = Pinjaman::where('status', 'disetujui')->get();
        return view('petugas.pinjaman.pinjaman', compact('pinjamanAktif', 'pengajuanPinjaman'));
    }
}
