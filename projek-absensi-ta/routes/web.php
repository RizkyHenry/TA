<?php
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CrudkaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormuserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CrudjabatanController;
use App\Http\Controllers\CrudjadwalController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ControllerAbsensi;
use App\Http\Controllers\ControllerDetail;
use App\Http\Controllers\AbsensiController;

use Illuminate\Support\Facades\Route;

// Tampilkan form login
Route::get('/', function () {
    return redirect()->route('loginForm');
});
Route::get('login', [SessionController::class, 'showLoginForm'])->name('loginForm');

// Proses login
Route::post('login', [SessionController::class, 'login'])->name('login');

// Rute lainnya
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('formuser', [FormuserController::class, 'index'])->name('formuser')->middleware('auth');
Route::post('logout', [SessionController::class, 'logout'])->name('logout');

// Rute untuk jabatan
Route::resource('jabatan', CrudjabatanController::class)->middleware('auth');

// Rute untuk jadwal
Route::resource('jadwal', CrudjadwalController::class)->middleware('auth');

// Rute untuk karyawan (CRUD resource routes)
Route::resource('karyawan', KaryawanController::class)->middleware('auth');
Route::post('/karyawan/delete', [KaryawanController::class, 'destroy'])->name('karyawan.deletes')->middleware('auth');
// 
Route::put('/karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.update')->middleware('auth');



// Rute untuk absensi
Route::resource('absensi', AbsensiController::class)->middleware('auth');
Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');


// Route untuk menampilkan semua detail
Route::get('/details', [ControllerDetail::class, 'index']);

// Route untuk menampilkan satu detail berdasarkan ID
Route::get('/api/details/{id}', [ControllerDetail::class, 'show']);

// Route untuk membuat detail baru
Route::post('/details', [ControllerDetail::class, 'store']);

// Route untuk mengupdate detail yang ada
Route::put('/details/{id}', [ControllerDetail::class, 'update']);

// Route untuk menghapus detail
Route::delete('/details/{id}', [ControllerDetail::class, 'destroy']);