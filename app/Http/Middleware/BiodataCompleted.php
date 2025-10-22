<?php

// app/Http/Middleware/BiodataCompleted.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataCompleted
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Cek hanya jika user adalah 'anggota' dan belum melengkapi data diri
        if ($user->role === 'anggota' && !$user->biodata()) {
             // Redirect ke halaman untuk melengkapi profil
             return redirect()->route('anggota.profile.create')->with('warning', 'Harap lengkapi data diri Anda terlebih dahulu.');
        }

        return $next($request);
    }
}