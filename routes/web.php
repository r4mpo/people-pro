<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\User\BeneficiosController as Beneficios;

Route::get('/', function () {
    return view('system.user.home');
})->name('dashboard')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/sistema')->group(function () {

    Route::prefix('/usuario')->group(function () {

        Route::prefix('/beneficios')->group(function () {
            Route::get('/', [Beneficios::class, 'index'])->name('sistema.usuario.beneficios.entrar');
            Route::get('/cadastrar', [Beneficios::class, 'create'])->name('sistema.usuario.beneficios.cadastrar');
            Route::post('/salvar', [Beneficios::class, 'store'])->name('sistema.usuario.beneficios.salvar');
            Route::get('/visualizar/{id}', [Beneficios::class, 'show'])->name('sistema.usuario.beneficios.visualizar');
            Route::get('/editar/{id}', [Beneficios::class, 'edit'])->name('sistema.usuario.beneficios.editar');
            Route::get('/atualizar/{id}', [Beneficios::class, 'update'])->name('sistema.usuario.beneficios.atualizar');
            Route::get('/excluir/{id}', [Beneficios::class, 'destroy'])->name('sistema.usuario.beneficios.excluir');
        });

    });

});

require __DIR__ . '/auth.php';