<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\SimpananController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\LoginController::class, 'showLoginForm']);
Route::post('/', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// Temporary route
Route::get('/temp-register', function () {
    return view('register');
});
Route::get('/temp-forgot-password', function () {
    return view('forgot-password');
});
Route::get('/temp-new-password', function () {
    return view('new-password');
});

// All Temp
Route::get('/temp-edit-user', function () {
    return view('edit-user');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Temp
    Route::middleware('role:admin')->group(function () {
        // Route::get('/temp-admin-dashboard', function () {
        //     return view('admin-dashboard');
        Route::get('/temp-admin-dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/temp-admin-user-management', [App\Http\Controllers\AdminController::class, 'users']);
        Route::get('/temp-admin-create-user', [App\Http\Controllers\AdminController::class, 'createUser']);
        Route::post('/temp-admin-store-user', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('user.store');
        Route::delete('/temp-admin-delete-user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('user.delete');


        Route::get('/temp-admin-management-koperasi', [App\Http\Controllers\AdminController::class, 'koperasiManagement']);
        
        Route::get('/temp-admin-add-user', function () {
            return view('admin-add-user');
        });
        Route::get('/temp-admin-laporan-keuangan', function () {
            return view('admin-laporan-keuangan');
        });
    });

    // Petugas
    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/dashboard', function () {
            return 'Dashboard Petugas';
        });
    });
});

// BiodataController
Route::get('/biodata/create', [BiodataController::class, 'create'])->name('biodata.create');
Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
Route::get('/biodata/{biodata}', [BiodataController::class, 'show'])->name('biodata.show');
Route::get('/biodata/{biodata}/edit', [BiodataController::class, 'edit'])->name('biodata.edit');
Route::put('/biodata/{biodata}', [BiodataController::class, 'update'])->name('biodata.update');
Route::delete('/biodata/{biodata}', [BiodataController::class, 'destroy'])->name('biodata.destroy');

// Route SimpananController
Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
Route::post('/simpanan', [SimpananController::class, 'store'])->name('simpanan.store');
Route::get('/simpanan/{biodata}', [SimpananController::class, 'index'])->name('simpanan.index');
Route::delete('/simpanan/{simpanan}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');

// Route PinjamanController
Route::get('/pinjaman/create', [PinjamanController::class, 'create'])->name('pinjaman.create');
Route::post('/pinjaman', [PinjamanController::class, 'store'])->name('pinjaman.store');
Route::get('/pinjaman/{biodata}', [PinjamanController::class, 'index'])->name('pinjaman.index');
Route::post('/pinjaman/{pinjaman}/approve', [PinjamanController::class, 'approve'])->name('pinjaman.approve');
