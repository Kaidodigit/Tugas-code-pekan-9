<?php

use App\Http\Controllers\RakController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;


// Halaman utama -> login
Route::get('/', fn () => redirect()->route('login'));

// Login & logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin + Staff: lihat, tambah, ubah
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/rak', [RakController::class, 'daftar'])->name('rak.index');
    Route::get('/rak/create', [RakController::class, 'create'])->name('rak.create');
    Route::post('/rak', [RakController::class, 'store'])->name('rak.store');
    Route::get('/rak/{id}/edit', [RakController::class, 'edit'])->name('rak.edit');
    Route::put('/rak/{id}', [RakController::class, 'update'])->name('rak.update');
});

// Hanya Admin: hapus
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/rak/{id}', [RakController::class, 'destroy'])->name('rak.destroy');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
// Route Create & Store (Tambah Data)
Route::get('/rak/create', [RakController::class, 'create'])->name('rak.create');
Route::post('/rak', [RakController::class, 'store'])->name('rak.store');

// Route Edit & Update (Ubah Data)
Route::get('/rak/{id}/edit', [RakController::class, 'edit'])->name('rak.edit');
Route::put('/rak/{id}', [RakController::class, 'update'])->name('rak.update');

// Route Destroy (Hapus Data) -> Pastikan method-nya 'destroy'
Route::delete('/rak/{id}', [RakController::class, 'destroy'])->name('rak.destroy');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Test Koneksi Database
Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e) {
        return "DB gagal connect: " . $e->getMessage();
    }
});