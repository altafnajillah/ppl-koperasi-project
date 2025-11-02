<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifikasi = $user->notifikasi;

        return view('anggota.notifikasi', ['user' => $user, 'notifikasi' => $notifikasi]);
    }
}
