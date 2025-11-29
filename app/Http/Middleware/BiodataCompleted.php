<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataCompleted
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user()->load('biodata');

        if ($request->routeIs('anggota.biodata')) {
            return $next($request);
        }

        if (! $user->biodata) {
            return redirect()->route('anggota.biodata')
                ->with('warning', 'Harap lengkapi data diri Anda terlebih dahulu untuk mengakses halaman ini.');
        }

        if ($user->biodata->accepted_at === null) {
            return redirect()->route('anggota.biodata')
                ->with('warning', 'Menunggu persetujuan biodata Anda. Silakan cek kembali nanti.');
        }

        return $next($request);
    }
}
