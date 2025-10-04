<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\KomponenGajiController;
use App\Http\Controllers\Admin\PenggajianController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect', function () {
    if (Auth::user()->role === 'Admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('public.dashboard');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === GRUP RUTE ADMIN ===
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Rute Anggota
    Route::resource('anggota', AnggotaController::class);

    // Rute Komponen Gaji
    Route::resource('komponen-gaji', KomponenGajiController::class);
    
    // Rute Penggajian (BAGIAN INI YANG DIPERBAIKI)
    Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');
    Route::get('/penggajian/create', [PenggajianController::class, 'create'])->name('penggajian.create');
    Route::post('/penggajian', [PenggajianController::class, 'store'])->name('penggajian.store');
    Route::get('/penggajian/{anggota}', [PenggajianController::class, 'show'])->name('penggajian.show');
    Route::get('/penggajian/{anggota}/edit', [PenggajianController::class, 'edit'])->name('penggajian.edit');
    Route::put('/penggajian/{anggota}', [PenggajianController::class, 'update'])->name('penggajian.update');
    Route::delete('/penggajian/{anggota}/reset', [PenggajianController::class, 'resetPenggajian'])->name('penggajian.reset');
    Route::delete('/penggajian/{anggota}/{komponenGaji}', [PenggajianController::class, 'removeKomponen'])->name('penggajian.removeKomponen');
    
    // Rute untuk AJAX
    Route::get('/get-komponen-gaji/{anggota}', [PenggajianController::class, 'getKomponenGajiForAnggota'])->name('penggajian.getKomponen');
});

// === GRUP RUTE PUBLIC ===
Route::middleware(['auth', 'role:Public'])->prefix('public')->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('public.dashboard');
    Route::get('/anggota', [PublicController::class, 'showAnggota'])->name('public.anggota.index');
    Route::get('/penggajian', [PublicController::class, 'showPenggajian'])->name('public.penggajian.index');
});

require __DIR__.'/auth.php';