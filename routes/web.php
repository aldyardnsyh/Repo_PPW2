<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     return view('auth/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// // Menyediakan rute login yang tetap ada di /login
// Route::get('/login', function () {
//     return view('auth/login');
// })->name('login');

// require __DIR__.'/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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
    });
    // Cari Buku
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';