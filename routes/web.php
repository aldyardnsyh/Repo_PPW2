<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

    Route::middleware('admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::delete('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        // Edit Buku
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        // Update Buku
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        // Delete Image
        Route::post('/buku/edit/{id}/delete-image/{image_id}', [BukuController::class, 'destroyImage'])->name('buku.destroyImage');
    });
    // Cari Buku
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/detail_buku/{id}', [BukuController::class, 'galbuku'])->name('buku.galeri');
    Route::get('/buku/{id}', [BukuController::class, 'details'])->name('buku.detail');
    Route::post('/buku/{id}/rate', [BukuController::class, 'submitRating'])->name('buku.rate');
    Route::patch('/buku/rate/{id}', [BukuController::class, 'updateRating'])->name('buku.updateRating');
});

require __DIR__ . '/auth.php';
