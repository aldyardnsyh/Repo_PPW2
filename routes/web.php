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

    Route::get('/buku/favourite', [BukuController::class, 'myFavouriteBooks'])->name('buku.favourite');
    Route::post('/buku/add-to-favourite/{id}', [BukuController::class, 'addToFavourite'])->name('buku.addToFavourite');
    Route::delete('/buku/unfavourite/{id}', [BukuController::class, 'unfavourite'])->name('buku.unfavourite');
    Route::get('/buku/rating/{id}', [BukuController::class, 'rating'])->name('buku.rating');
    Route::post('/buku/rating/{id}', [BukuController::class, 'submitRating'])->name('buku.submitRating');
    Route::get('/buku/detail/{id}', [BukuController::class, 'details'])->name('buku.details');
});

require __DIR__ . '/auth.php';
