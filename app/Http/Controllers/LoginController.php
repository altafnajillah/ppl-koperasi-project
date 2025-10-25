<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Terapkan middleware 'guest' ke semua method di controller ini
     * kecuali untuk method 'logout'.
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    /**
     * Menampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan login yang masuk.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // 2. Coba untuk mengautentikasi pengguna
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // 3. Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();

            // 4. Redirect berdasarkan role pengguna
            if ($user->role === 'admin') {

                return redirect()->intended(route('admin.dashboard'));
            }
            if ($user->role === 'petugas') {
                return redirect()->intended(route('petugas.dashboard'));
            }
            if ($user->role === 'anggota') {
                return redirect()->intended(route('anggota.dashboard'));
            }

            // Fallback default jika role tidak ada
            return redirect()->intended()->with('message', "Role tidak ditemukan");
        } else {
            return redirect()->intended()->with('message', "Username atau Password tidak sesuai");
        }

        // 5. Jika gagal, kembalikan ke form login dengan pesan error
        // throw ValidationException::withMessages([
        //     'email' => __('auth.failed'), // Menggunakan pesan standar dari Laravel
        // ]);
    }

    /**
     * Melakukan logout pengguna.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session dan regenerate token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
