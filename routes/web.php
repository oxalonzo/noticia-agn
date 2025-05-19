<?php

use App\Http\Controllers\DestacadaController;
use App\Http\Controllers\LectoresController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;



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

    //usuarios admin
    Route::get('/usuarios', [UsuarioController::class, 'index'])->middleware('auth')->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->middleware('auth')->name('usuarios.create');
    Route::post('/usuarios/store', [UsuarioController::class, 'store'])->middleware('auth')->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->middleware('auth')->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->middleware('auth')->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->middleware('auth')->name('usuarios.destroy');

     //noticia destacada
    Route::get('/destacada', [DestacadaController::class, 'index'])->middleware('auth')->name('destacada.index');
    Route::get('/destacada/create', [DestacadaController::class, 'create'])->middleware('auth')->name('destacada.create');
    Route::post('/destacada/store', [DestacadaController::class, 'store'])->middleware('auth')->name('destacada.store');
    Route::get('/destacada/{id}/edit', [DestacadaController::class, 'edit'])->middleware('auth')->name('destacada.edit');
    Route::put('/destacada/{id}', [DestacadaController::class, 'update'])->middleware('auth')->name('destacada.update');
    Route::delete('/destacada/{id}', [DestacadaController::class, 'destroy'])->middleware('auth')->name('destacada.destroy');


    //mostrar las noticias y ver una en especifico
    Route::get('/', [LectoresController::class, 'index'])->name('noticias.index');
    Route::get('/noticia/{id}/show', [LectoresController::class, 'show'])->name('noticias.show');
    Route::get('/destacada/{id}/show', [LectoresController::class, 'MostrarDestacada'])->name('noticia.destacada');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
