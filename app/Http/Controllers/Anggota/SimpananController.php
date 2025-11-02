<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->simpanan();
    
        if ($request->filled('dari_tanggal')) {
            $query->where('tanggal', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->where('tanggal', '<=', $request->sampai_tanggal);
        }
    
        if ($request->filled('jenis_simpanan')) {
            $query->where('jenis', $request->jenis_simpanan);
        }    
    
        $simpanans = $query->orderByDesc('tanggal')->get();

        return view('anggota.simpanan', ['user' => $user, 'simpanans' => $simpanans]);
    }
}
