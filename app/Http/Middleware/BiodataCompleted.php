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

        $isBiodataIncomplete = ($user->biodata == null);

        if ($isBiodataIncomplete) {

            return redirect()->route('anggota.biodata')
                ->with('warning', 'Harap lengkapi data diri Anda terlebih dahulu untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
