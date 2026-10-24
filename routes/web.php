<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

// Rute Publik
Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', [HomeController::class, 'tentang']);
Route::get('/kontak', [HomeController::class, 'kontak']);

// Rute Profil
Route::get('/profile', [ProfileController::class, 'edit'])
    ->middleware(['auth'])
    ->name('profile.edit');

// Rute Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute CRUD Buku
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
});

// Rute Otentikasi Laravel
require __DIR__ . '/auth.php';
