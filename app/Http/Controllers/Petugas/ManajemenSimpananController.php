<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class ManajemenSimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('user')->get()->sortByDesc('tanggal');
        return view('petugas.simpanan.simpanan', ['simpanans' => $simpanans]);
    }
}
