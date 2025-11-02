<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pinjamans = $user->pinjaman;
        return view('anggota.pinjaman.pinjaman', ['user' => $user, 'pinjamans' => $pinjamans]);
    }
}
