<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

// Rute Publik (Halaman Utama, Tentang, Kontak)
Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', [HomeController::class, 'tentang']);
Route::get('/kontak', [HomeController::class, 'kontak']);

Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

// Rute Dashboard (Diperlukan setelah login agar tidak terjadi error Route [dashboard] not defined)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Blok Rute CRUD Buku (Pertemuan 6 - Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
});

// Rute Otentikasi Bawaan Laravel Breeze/Jetstream
require __DIR__.'/auth.php';