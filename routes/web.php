<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerawatanArmadaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// INI YANG NGIKUTIN TUTORIAL DI LMS
// Route::get('/tes-koneksi', function () {
//    try{
//        DB::connection()->getPdo();
//        return "DB berhasil connect!";
//
//    } catch (\Exception $e) {
//        return "DB gagal Connect: " . $e-> getMessage();
//    }
// })->withoutMiddleware('web');

// route buat login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'Login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Rute untuk mengeksekusi logika CRUD (Create, Read, Update untuk admin & petugas)
    Route::post('/perawatan/store', [PerawatanArmadaController::class, 'store'])->name('perawatan.store');
    Route::post('/perawatan/update/{id}', [PerawatanArmadaController::class, 'update'])->name('perawatan.update');
    Route::get('/perawatan', [PerawatanArmadaController::class, 'index'])->name('perawatan.index');

    // Delete hanya diizinkan untuk role admin
    Route::get('/perawatan/hapus/{id}', [PerawatanArmadaController::class, 'destroy'])
        ->middleware('role:admin')
        ->name('perawatan.destroy');
});
