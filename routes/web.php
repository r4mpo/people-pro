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

Route::prefix('/sistema')->middleware('auth')->group(function () {

    Route::prefix('/usuario')->group(function () {

        Route::prefix('/beneficios')->group(function () {
            Route::get('/', [Beneficios::class, 'index'])->name('sistema.usuario.beneficios.entrar');
            Route::get('/vincular-beneficio-usuario-view', [Beneficios::class, 'vincular_beneficio_usuario_view'])->name('sistema.usuario.beneficios.vincular_beneficio_usuario_view');
            Route::post('/vincular-beneficio-usuario-exe', [Beneficios::class, 'vincular_beneficio_usuario_exe'])->name('sistema.usuario.beneficios.vincular_beneficio_usuario_exe');
            Route::post('/desvincular-beneficio-usuario-exe', [Beneficios::class, 'desvincular_beneficio_usuario_exe'])->name('sistema.usuario.beneficios.desvincular_beneficio_usuario_exe');
        });

    });

});

require __DIR__ . '/auth.php';