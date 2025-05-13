<?php

use App\Http\Controllers\LectoresController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


    // Route::get('/', [LectoresController::class, 'index'])->name('welcome');
    // Route::get('/noticia/{id}', [LectoresController::class, 'show'])->name('noticia.show');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NoticiasController::class, 'index'])->name('dashboard');
    Route::get('/noticia/create', [NoticiasController::class, 'create'])->name('noticia.create');
    Route::post('/noticia/store', [NoticiasController::class, 'store'])->name('noticia.store');
    Route::get('/noticia/{id}/edit', [NoticiasController::class, 'edit'])->name('noticia.edit');
    Route::put('/noticia/{id}', [NoticiasController::class, 'update'])->name('noticia.update');
    Route::delete('/noticia/{id}', [NoticiasController::class, 'destroy'])->name('noticia.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
