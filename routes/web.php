<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Gestão de Estúdios
    Route::prefix('admin/estudios')->group(function () {
        Route::get('/', [EstudioController::class, 'adminList'])->name('admin.estudios.list');
        Route::get('/novo', [EstudioController::class, 'create'])->name('admin.estudios.create');
        Route::post('/', [EstudioController::class, 'store'])->name('admin.estudios.store');
        Route::get('/{id}/editar', [EstudioController::class, 'edit'])->name('admin.estudios.edit');
        Route::put('/{id}', [EstudioController::class, 'update'])->name('admin.estudios.update');
        Route::delete('/{id}', [EstudioController::class, 'destroy'])->name('admin.estudios.destroy');
    });

    // Gestão de Filmes
    Route::prefix('admin/filmes')->group(function () {
        Route::get('/', [FilmeController::class, 'adminList'])->name('admin.filmes.list');
        Route::get('/novo', [FilmeController::class, 'create'])->name('admin.filmes.create');
        Route::post('/', [FilmeController::class, 'store'])->name('admin.filmes.store');
        Route::get('/{id}/editar', [FilmeController::class, 'edit'])->name('admin.filmes.edit');
        Route::put('/{id}', [FilmeController::class, 'update'])->name('admin.filmes.update');
        Route::delete('/{id}', [FilmeController::class, 'destroy'])->name('admin.filmes.destroy');
    });

    // Gestão de Utilizadores
    Route::prefix('admin/users')->group(function () {
        Route::get('/', [UserController::class, 'adminList'])->name('admin.users.list');
        Route::get('/novo', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}/editar', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Rotas do Perfil do Utilizador
    Route::get('/perfil', [App\Http\Controllers\UserController::class, 'perfil'])->name('perfil.show');
    Route::post('/perfil/atualizar', [App\Http\Controllers\UserController::class, 'atualizarPerfil'])->name('perfil.update');

});

Route::get('/', [EstudioController::class, 'home'])->name('homepage');

Route::get('/estudios', [EstudioController::class, 'list'])->name('estudios.list');
Route::get('/estudios/{id}/filmes', [EstudioController::class, 'show'])->name('estudios.show');

Route::get('/filmes', [FilmeController::class, 'list'])->name('filmes.list');
Route::get('/filmes/{id}', [FilmeController::class, 'show'])->name('filmes.show');
