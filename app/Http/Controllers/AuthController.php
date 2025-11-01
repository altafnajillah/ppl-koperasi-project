<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Validation\ValidationException;

class AuthController extends Controller
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
            return redirect()->intended()->with('message', 'Role tidak ditemukan');
        } else {
            return redirect()->intended()->with('message', 'Username atau Password tidak sesuai');
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

    public function emailVerificationNotice()
    {
        return view('auth.verifikasi-email');
    }

    public function emailVerified(EmailVerificationRequest $request)
    {
        $request->fulfill();

        $user = Auth::user();

        if ($user->role === 'admin') {

            return redirect()->intended(route('admin.dashboard'));
        }
        else if ($user->role === 'petugas') {
            return redirect()->intended(route('petugas.dashboard'));
        }
        else {
            return redirect()->intended(route('anggota.dashboard'));
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Link verifikasi baru telah dikirim ke email Anda!');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input registrasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota', // Set role default sebagai anggota
        ]);

        // Otentikasi pengguna baru
        Auth::login($user);

        // Redirect ke dashboard atau halaman lain setelah registrasi
        return redirect()->route('anggota.dashboard');
    }
}
