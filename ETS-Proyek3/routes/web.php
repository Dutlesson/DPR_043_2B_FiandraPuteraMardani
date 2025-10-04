<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AnggotaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/redirect', function () {
    if (Auth::user()->role === 'Admin') {
        return redirect('/admin');
    }
    return redirect('/public');
})->middleware('auth');

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    
    Route::get('/admin/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/admin/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/admin/anggota', [AnggotaController::class, 'store'])->name('anggota.store');

    // ... (rute admin lainnya nanti bisa ditambahkan di sini)  
});

Route::middleware(['auth', 'role:Admin'])->get('/admin', [AdminController::class, 'index']);
Route::middleware(['auth', 'role:Public'])->get('/public', [PublicController::class, 'index']);

require __DIR__.'/auth.php';
