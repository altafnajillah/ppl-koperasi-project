<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

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
        } elseif ($user->role === 'petugas') {
            return redirect()->intended(route('petugas.dashboard'));
        } else {
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        Notifikasi::create([
            'user_id' => $user->id,
            'pesan' => 'Selamat datang di Koperasi Kami! Akun Anda telah berhasil dibuat via Register.',
            'dibaca' => false,
            'tanggal' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('anggota.dashboard');
    }

    public function requestView()
    {
        return view('auth.lupa-password');
    }

    public function sendEmail(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        // Kirim link reset password
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return view('auth.verifikasi-lupa-password')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }

    public function resetView(Request $request)
    {
        return view('auth.new-password', [
            'token' => $request->route('token'),
            'email' => $request->email,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Proses reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password, // Auto hash oleh model User L12
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Redirect ke login dengan pesan sukses
            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
