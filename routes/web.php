<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes(['verify' => true]);

Route::middleware('redirect.if.verified')->group(function () {
    Route::get('/', [App\Http\Controllers\AuthController::class, 'showLoginForm']);
    Route::post('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Temporary route
Route::get('/lupa-password', [App\Http\Controllers\AuthController::class, 'requestView'])->name('lupa.password');
// Route::get('/verifikasi-lupa-password', function () {
//     return view('auth.verifikasi-lupa-password');
// });
// Route::get('/new-password', function () {
//     return view('auth.new-password');
// });

Route::post('forgot-password', [App\Http\Controllers\AuthController::class, 'sendEmail'])
    ->name('password.email');

// 2. Reset Password (Link dari email mengarah ke sini)
Route::get('reset-password/{token}', [App\Http\Controllers\AuthController::class, 'resetView'])
    ->name('password.reset');

Route::post('reset-password', [App\Http\Controllers\AuthController::class, 'updatePassword'])
    ->name('password.store');

// ================= Email Verification Routes =================

Route::middleware('auth')->group(function () {
    Route::get('/verify-notice', [App\Http\Controllers\AuthController::class, 'emailVerificationNotice'])->middleware('redirect.if.verified')->name('verification.notice');
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
        Route::get('/admin/pengguna/profil-user/{id}', [App\Http\Controllers\AdminController::class, 'profileUser'])->name('admin.user.profile');

        // Menu Pinjaman
        Route::get('/admin/pinjaman/', [App\Http\Controllers\Admin\ManajemenPinjamanController::class, 'index']);
        Route::get('/admin/pinjaman/tambah-pinjaman', [App\Http\Controllers\Admin\ManajemenPinjamanController::class, 'create']);
        Route::post('/admin/pinjaman/tambah-pinjaman', [App\Http\Controllers\Admin\ManajemenPinjamanController::class, 'store'])->name('admin.pinjaman.store');
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
        Route::get('/admin/simpanan', [App\Http\Controllers\Admin\ManajemenSimpananController::class, 'index']);
        Route::get('/admin/simpanan/tambah-simpanan', [App\Http\Controllers\Admin\ManajemenSimpananController::class, 'create']);
        Route::post('/admin/simpanan/tambah-simpanan', [App\Http\Controllers\Admin\ManajemenSimpananController::class, 'store']);
        Route::get('/admin/simpanan/edit-simpanan/{id}', [App\Http\Controllers\Admin\ManajemenSimpananController::class, 'edit']);
        Route::put('/admin/simpanan/{id}', [App\Http\Controllers\Admin\ManajemenSimpananController::class, 'update']);
        Route::get('/admin/simpanan/simpanan-per-anggota', [App\Http\Controllers\Admin\ManajemenSimpananController::class, 'simpananPerAnggota']);

        // Menu Laporan Keuangan
        Route::get('/admin/laporan-keuangan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/admin/laporan-keuangan/export', [App\Http\Controllers\LaporanController::class, 'exportCsv'])->name('laporan.export');
    });

    // Petugas
    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/dashboard', [App\Http\Controllers\PetugasController::class, 'dashboard'])->name('petugas.dashboard');

        // Profile Anggota
        Route::get('/petugas/anggota', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'index'])->name('petugas.anggota.index');
        Route::get('/petugas/anggota/tambah-anggota', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'create'])->name('petugas.anggota.tambah');
        Route::get('/petugas/anggota/profil-anggota/{id}', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'show'])->name('petugas.anggota.show');
        Route::get('/petugas/anggota/edit-anggota/{id}', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'edit'])->name('petugas.anggota.edit');
        Route::put('/petugas/anggota/update-anggota/{id}', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'update'])->name('petugas.anggota.update');
        Route::delete('/petugas/anggota/delete-anggota/{id}', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'destroy'])->name('petugas.anggota.destroy');
        Route::post('/petugas/anggota/store-anggota', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'store'])->name('petugas.anggota.store');

        Route::post('/petugas/anggota/accept-biodata/{id}', [App\Http\Controllers\Petugas\ManajemenAnggotaController::class, 'acceptBiodata'])->name('petugas.anggota.acceptBiodata');

        // Menu Pinjaman
        Route::get('/petugas/pinjaman', [App\Http\Controllers\Petugas\ManajemenPinjamanController::class, 'index']);
        Route::get('/petugas/pinjaman/tambah-pinjaman', [App\Http\Controllers\Petugas\ManajemenPinjamanController::class, 'create']);
        Route::post('/petugas/pinjaman/tambah-pinjaman', [App\Http\Controllers\Petugas\ManajemenPinjamanController::class, 'store'])->name('petugas.pinjaman.store');
        Route::post('/petugas/pinjaman/approve-pinjaman/{id}', [App\Http\Controllers\Petugas\ManajemenPinjamanController::class, 'approve'])->name('petugas.pinjaman.approve');

        Route::get('/petugas/pinjaman/tambah-angsuran', function () {
            return view('petugas.pinjaman.tambah-angsuran');
        });
        Route::get('/petugas/pinjaman/riwayat-angsuran', function () {
            return view('petugas.pinjaman.riwayat-angsuran');
        });

        // Menu Simpanan
        Route::get('/petugas/simpanan', [App\Http\Controllers\Petugas\ManajemenSimpananController::class, 'index']);
        Route::get('/petugas/simpanan/tambah-simpanan', [App\Http\Controllers\Petugas\ManajemenSimpananController::class, 'create']);
        Route::post('/petugas/simpanan/tambah-simpanan', [App\Http\Controllers\Petugas\ManajemenSimpananController::class, 'store']);
        Route::get('/petugas/simpanan/edit-simpanan/{id}', [App\Http\Controllers\Petugas\ManajemenSimpananController::class, 'edit']);
        Route::put('/petugas/simpanan/{id}', [App\Http\Controllers\Petugas\ManajemenSimpananController::class, 'update']);
        // Route::get('/petugas/simpanan/simpanan-per-anggota', function () {
        //     return view('petugas.simpanan.simpanan-per-anggota');
        // });
        Route::get('/petugas/simpanan/simpanan-per-anggota', [App\Http\Controllers\Petugas\ManajemenSimpananController::class, 'simpananPerAnggota']);

        // Ganti Password
        Route::get('/petugas/ganti-password', function () {
            return view('petugas.ganti-password');
        });

    });

    // Anggota
    Route::middleware(['role:anggota'])->group(function () {

        Route::get('/anggota/biodata/', [App\Http\Controllers\BiodataController::class, 'index'])->name('anggota.biodata');
        Route::post('/anggota/biodata/', [App\Http\Controllers\BiodataController::class, 'store'])->name('anggota.biodata.store');
        Route::put('/anggota/biodata/', [App\Http\Controllers\BiodataController::class, 'update'])->name('anggota.biodata.update');

        Route::middleware(['biodata.completed'])->group(function () {

            Route::get('/anggota/dashboard', [App\Http\Controllers\AnggotaController::class, 'dashboard'])
                ->name('anggota.dashboard');

            // Ganti Password
            Route::get('/anggota/ganti-password', function () {
                return view('anggota.ganti-password');
            });
            Route::post('/anggota/ganti-password', [App\Http\Controllers\AnggotaController::class, 'changePassword'])->name('anggota.changePassword');

            // Pinjaman
            Route::get('/anggota/pinjaman', [App\Http\Controllers\Anggota\PinjamanController::class, 'index'])->name('anggota.pinjaman');
            Route::get('/anggota/pinjaman/tambah-pinjaman', [App\Http\Controllers\Anggota\PinjamanController::class, 'create'])->name('anggota.pinjaman.tambah');
            Route::post('/anggota/pinjaman/tambah-pinjaman', [App\Http\Controllers\Anggota\PinjamanController::class, 'store'])->name('anggota.pinjaman.store');
            // Route::get('/anggota/pinjaman/riwayat-angsuran', function () {
            //     return view('anggota.pinjaman.riwayat-angsuran');
            // });
            Route::get('/anggota/pinjaman/riwayat-angsuran/{id}', [App\Http\Controllers\Anggota\PinjamanController::class, 'riwayatAngsuran']);

            // Simpanan
            Route::get('/anggota/simpanan', [App\Http\Controllers\Anggota\SimpananController::class, 'index'])->name('anggota.simpanan');

            // Notifikasi
            Route::get('/anggota/notifikasi', [App\Http\Controllers\Anggota\NotifikasiController::class, 'index'])->name('anggota.notifikasi');
        });
    });
});
