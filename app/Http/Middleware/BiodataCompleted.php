<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataCompleted
{
    public function handle(Request $request, Closure $next)
    {
        // Pengecekan standar
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user()->load('biodata');

        // Cek jika user adalah 'anggota' (jika perlu)
        // if (!$user->hasRole('anggota')) {
        //     return $next($request);
        // }

        $isBiodataIncomplete = ($user->biodata == null);

        // Pengecualian agar tidak loop:
        // Izinkan akses ke halaman 'create' dan 'store' (untuk POST form)
        // $isAllowedaRoute = $request->routeIs('anggota.biodata.create') ||
        //                    $request->routeIs('anggota.biodata.store'); // Penting untuk POST

        // JIKA BIODATA KOSONG dan user TIDAK sedang di halaman yang diizinkan
        if ($isBiodataIncomplete
            // && !$isAllowedaRoute
        ) {

            // PAKSA user ke halaman 'create' biodata
            return redirect()->route('anggota.biodata.create')
                ->with('warning', 'Harap lengkapi data diri Anda terlebih dahulu untuk mengakses halaman ini.');
        }

        // JIKA BIODATA SUDAH ADA, tapi user malah nyasar ke halaman 'create'
        // if (! $isBiodataIncomplete && $isAllowedaRoute) {
        //     // Opsional: Kirim mereka ke dashboard
        //     return redirect()->route('anggota.dashboard');
        // }

        // Jika lolos semua cek (misal: biodata lengkap dan akses dashboard)
        return $next($request);
    }
}
