<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\SimpananController;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\AuthController::class, 'showLoginForm']);
Route::post('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');

// Temporary route
Route::get('/lupa-password', function () {
    return view('auth.lupa-password');
});
Route::get('/verifikasi-lupa-password', function () {
    return view('auth.verifikasi-lupa-password');
});
Route::get('/new-password', function () {
    return view('auth.new-password');
});

// ================= Email Verification Routes =================

Route::middleware('auth')->group(function () {
    Route::get('/verify-notice', [App\Http\Controllers\AuthController::class, 'emailVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\AuthController::class, 'emailVerified'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [App\Http\Controllers\AuthController::class, 'resendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Route
    Route::middleware('role:admin')->group(function () {
        // Dashboard Admin
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Menu Manajemen Pengguna
        Route::get('/admin/pengguna/user-management', [App\Http\Controllers\AdminController::class, 'users']);
        Route::get('/admin/pengguna/create-user', [App\Http\Controllers\AdminController::class, 'createUser']);
        Route::post('/admin/store-user', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('user.store');
        Route::get('/admin/pengguna/edit-user', function () {
            return view('admin.pengguna.edit-user');
        });
        Route::delete('/admin/delete-user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('user.delete');
        Route::get('/admin/pengguna/profil-user', function () {
            return view('admin.pengguna.profil-user');
        });

        // Menu Pinjaman
        Route::get('/admin/pinjaman/', [App\Http\Controllers\AdminController::class, 'manajemenPinjaman']);
        Route::get('/admin/pinjaman/tambah-pinjaman', function () {
            return view('admin.pinjaman.tambah-pinjaman');
        });
        Route::get('/admin/pinjaman/edit-pinjaman', function () {
            return view('admin.pinjaman.edit-pinjaman');
        });
        Route::get('/admin/pinjaman/tambah-angsuran', function () {
            return view('admin.pinjaman.tambah-angsuran');
        });
        Route::get('/admin/pinjaman/riwayat-angsuran', function () {
            return view('admin.pinjaman.riwayat-angsuran');
        });

        // Menu Simpanan
        Route::get('/admin/simpanan', function () {
            return view('admin.simpanan.simpanan');
        });
        Route::get('/admin/simpanan/simpanan-per-anggota', function () {
            return view('admin.simpanan.simpanan-per-anggota');
        });
        Route::get('/admin/simpanan/tambah-simpanan', function () {
            return view('admin.simpanan.tambah-simpanan');
        });
        Route::get('/admin/simpanan/edit-simpanan', function () {
            return view('admin.simpanan.edit-simpanan');
        });

        // Menu Laporan Keuangan
        Route::get('/admin/laporan-keuangan', function () {
            return view('admin.laporan-keuangan');
        });
    });

    // Petugas
    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/dashboard', [App\Http\Controllers\PetugasController::class, 'dashboard'])->name('petugas.dashboard');

        // Profile Anggota
        Route::get('/petugas/anggota', function () {
            return view('petugas.anggota.manajemen-anggota');
        });
        Route::get('/petugas/anggota/tambah-anggota', function () {
            return view('petugas.anggota.tambah-anggota');
        });
        Route::get('/petugas/anggota/edit-anggota', function () {
            return view('petugas.anggota.edit-anggota');
        });
        Route::get('/petugas/anggota/profil-anggota', function () {
            return view('petugas.anggota.profil-anggota');
        });

        // Menu Pinjaman
        Route::get('/petugas/pinjaman', function () {
            return view('petugas.pinjaman.pinjaman');
        });
        Route::get('/petugas/pinjaman/tambah-pinjaman', function () {
            return view('petugas.pinjaman.tambah-pinjaman');
        });
        Route::get('/petugas/pinjaman/tambah-angsuran', function () {
            return view('petugas.pinjaman.tambah-angsuran');
        });
        Route::get('/petugas/pinjaman/riwayat-angsuran', function () {
            return view('petugas.pinjaman.riwayat-angsuran');
        });

        // Menu Simpanan
        Route::get('/petugas/simpanan', function () {
            return view('petugas.simpanan.simpanan');
        });
        Route::get('/petugas/simpanan/tambah-simpanan', function () {
            return view('petugas.simpanan.tambah-simpanan');
        });
        Route::get('/petugas/simpanan/edit-simpanan', function () {
            return view('petugas.simpanan.edit-simpanan');
        });
        Route::get('/petugas/simpanan/simpanan-per-anggota', function () {
            return view('petugas.simpanan.simpanan-per-anggota');
        });

        // Ganti Password
        Route::get('/petugas/ganti-password', function () {
            return view('petugas.ganti-password');
        });

    });

    // Anggota
    Route::middleware(['role:anggota'])->group(function () {

        Route::get('/anggota/biodata/create', [App\Http\Controllers\BiodataController::class, 'create'])->name('anggota.biodata.create');

        Route::post('/anggota/biodata/store', [App\Http\Controllers\BiodataController::class, 'store'])
            ->name('anggota.biodata.store');

        Route::middleware(['biodata.completed'])->group(function () {

            Route::get('/anggota/dashboard', [App\Http\Controllers\AnggotaController::class, 'dashboard'])
                ->name('anggota.dashboard');

            Route::get('/anggota/biodata', [App\Http\Controllers\BiodataController::class, 'show'])
                ->name('anggota.biodata.show');
        });
    });
});

// Email Verification Notice Route
// Route::get('/verification-notice', function () {
//     return 'Mohon verifikasi email Anda terlebih dahulu sebelum mengakses halaman ini.';
// })->name('verification.notice');

// ====== Di komen, ada yang sudah di intergasikan ke atas =====
// BiodataController
// Route::get('/biodata/create', [BiodataController::class, 'create'])->name('biodata.create');
// Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
// Route::get('/biodata/{biodata}', [BiodataController::class, 'show'])->name('biodata.show');
// Route::get('/biodata/{biodata}/edit', [BiodataController::class, 'edit'])->name('biodata.edit');
// Route::put('/biodata/{biodata}', [BiodataController::class, 'update'])->name('biodata.update');
// Route::delete('/biodata/{biodata}', [BiodataController::class, 'destroy'])->name('biodata.destroy');

// Route SimpananController
// Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
// Route::post('/simpanan', [SimpananController::class, 'store'])->name('simpanan.store');
// Route::get('/simpanan/{biodata}', [SimpananController::class, 'index'])->name('simpanan.index');
// Route::delete('/simpanan/{simpanan}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');

// Route PinjamanController
// Route::get('/pinjaman/create', [PinjamanController::class, 'create'])->name('pinjaman.create');
// Route::post('/pinjaman', [PinjamanController::class, 'store'])->name('pinjaman.store');
// Route::get('/pinjaman/{biodata}', [PinjamanController::class, 'index'])->name('pinjaman.index');
// Route::post('/pinjaman/{pinjaman}/approve', [PinjamanController::class, 'approve'])->name('pinjaman.approve');
