<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifikasi = Notifikasi::where('user_id', $user->id)->orderByDesc('tanggal')->get();

        return view('anggota.notifikasi', ['user' => $user, 'notifikasi' => $notifikasi]);
    }

    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('id', $id)->first();

        if ($notifikasi) {
            $notifikasi->dibaca = true;
            $notifikasi->save();
        }

        return redirect()->back();
    }
}
