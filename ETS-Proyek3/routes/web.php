<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\KomponenGajiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/redirect', function () {
    if (Auth::user()->role === 'Admin') {
        return redirect()->route('admin.dashboard'); // Lebih baik redirect ke nama rute
    }
    return redirect()->route('public.dashboard'); // Lebih baik redirect ke nama rute
})->middleware('auth');

// Grup untuk semua rute Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Rute Anggota
    Route::get('/admin/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/admin/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/admin/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/admin/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/admin/anggota/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/admin/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Rute Komponen Gaji
    Route::get('/admin/komponen-gaji', [KomponenGajiController::class, 'index'])->name('komponen-gaji.index');
    Route::get('/admin/komponen-gaji/create', [KomponenGajiController::class, 'create'])->name('komponen-gaji.create');
    Route::post('/admin/komponen-gaji', [KomponenGajiController::class, 'store'])->name('komponen-gaji.store');
    // tambahkan edit, update, destroy
    Route::get('/admin/komponen-gaji/{komponenGaji}/edit', [KomponenGajiController::class, 'edit'])->name('komponen-gaji.edit');
    Route::put('/admin/komponen-gaji/{komponenGaji}', [KomponenGajiController::class, 'update'])->name('komponen-gaji.update');
    Route::delete('/admin/komponen-gaji/{komponenGaji}', [KomponenGajiController::class, 'destroy'])->name('komponen-gaji.destroy');
});

// Grup untuk semua rute Public
Route::middleware(['auth', 'role:Public'])->group(function () {
    Route::get('/public', [PublicController::class, 'index'])->name('public.dashboard');
    Route::get('/public/anggota', [PublicController::class, 'showAnggota'])->name('public.anggota.index');
});

require __DIR__.'/auth.php';