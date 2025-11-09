<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $role = $user->role;

        $homeRoute = match($role) {
            'admin'   => 'admin.dashboard',
            'petugas' => 'petugas.dashboard',
            default => 'anggota.dashboard',
            // 'anggota' => 'anggota.dashboard',
            // default   => 'home', // Sediakan fallback
        };

        if ($request->routeIs('verification.notice')) {
            
            if ($user->hasVerifiedEmail()) {
                return redirect()->route($homeRoute);
            }
    
            return $next($request);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route($homeRoute);
        }
        
        return redirect()->route('verification.notice');
    }
}
