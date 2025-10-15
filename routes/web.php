<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;

// Temporary route
Route::get('/', function () { return view('login');});
Route::get('/temp-register', function () { return view('register');});

//BiodataController
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

//Route PinjamanController
Route::get('/pinjaman/create', [PinjamanController::class, 'create'])->name('pinjaman.create');
Route::post('/pinjaman', [PinjamanController::class, 'store'])->name('pinjaman.store');
Route::get('/pinjaman/{biodata}', [PinjamanController::class, 'index'])->name('pinjaman.index');
Route::post('/pinjaman/{pinjaman}/approve', [PinjamanController::class, 'approve'])->name('pinjaman.approve');
