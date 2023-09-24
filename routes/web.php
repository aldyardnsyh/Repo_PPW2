<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\MencobaController;
use App\Models\Buku;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', [
        "name" => "pragos",
        "email" => "pragos@gmail.com"
    ]);
});

Route::get('/boom',[MencobaController::class,'boomesport']);

Route::get('/prx',[MencobaController::class,'prxesport']);

Route::get('/fnatic',[MencobaController::class,'fnaticsport']);

Route::get('/fpx',[MencobaController::class,'fpxesport']);

Route::get('/',[MencobaController::class,'beranda']);

Route::get('/buku', [BukuController::class,'index']);
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
// Buku Edit
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
// Buku Update
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
