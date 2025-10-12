<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;



// BiodataController
// ====================

// Tampilkan biodata berdasarkan ID
Route::get('/biodata/{biodata}', [BiodataController::class, 'show']);

// Form tambah biodata
Route::get('/biodata/create', [BiodataController::class, 'create']);
Route::post('/biodata', [BiodataController::class, 'store']);

// Form edit biodata
Route::get('/biodata/{biodata}/edit', [BiodataController::class, 'edit']);
Route::put('/biodata/{biodata}', [BiodataController::class, 'update']);

// Hapus biodata
Route::delete('/biodata/{biodata}', [BiodataController::class, 'destroy']);


// SimpananController
// ====================

// Form tambah simpanan
Route::get('/simpanan/create', [SimpananController::class, 'create']);
Route::post('/simpanan', [SimpananController::class, 'store']);

// Tampilkan simpanan milik anggota tertentu (berdasarkan ID anggota)
Route::get('/simpanan/{anggota}', [SimpananController::class, 'index']);

// Hapus simpanan (berdasarkan ID simpanan)
Route::delete('/simpanan/{simpanan}', [SimpananController::class, 'destroy']);


// PinjamanController
// ====================

// Form ajukan pinjaman
Route::get('/pinjaman/create', [PinjamanController::class, 'create']);
Route::post('/pinjaman', [PinjamanController::class, 'store']);

// Setujui pinjaman (berdasarkan ID pinjaman)
Route::get('/pinjaman/approve/{pinjaman}', [PinjamanController::class, 'approve']);

// Lihat pinjaman per anggota (berdasarkan ID anggota)
Route::get('/pinjaman/{anggota}', [PinjamanController::class, 'index']);


Route::get('/', function () {
    return view('welcome');
});
