<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\System\DashboardsController as Dashboards;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\User\BeneficiosController as Beneficios;
use App\Http\Controllers\System\User\EmpresasController as Empresas;
use App\Http\Controllers\System\User\SetoresController as Setores;
use App\Http\Controllers\System\User\CargosController as Cargos;
use App\Http\Controllers\System\User\ColaboradoresController as Colaboradores;
use App\Http\Controllers\System\User\FinanceirosController as Financeiros;

Route::get('/', [Dashboards::class, 'dashboard_usuarios_comuns'])->name('dashboard')->middleware('auth');


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

        Route::prefix('/empresa')->group(function () {
            Route::get('/', [Empresas::class, 'index'])->name('sistema.usuario.empresa.entrar');
            Route::put('/atualizar/{id}', [Empresas::class, 'update'])->name('sistema.usuario.empresa.atualizar');
        });

        Route::prefix('/setores')->group(function () {
            Route::get('/', [Setores::class, 'index'])->name('sistema.usuario.setores.entrar');
            Route::get('/criar', [Setores::class, 'create'])->name('sistema.usuario.setores.criar');
            Route::post('/cadastrar', [Setores::class, 'store'])->name('sistema.usuario.setores.cadastrar');
            Route::get('/editar/{id}', [Setores::class, 'edit'])->name('sistema.usuario.setores.editar');
            Route::put('/atualizar/{id}', [Setores::class, 'update'])->name('sistema.usuario.setores.atualizar');
            Route::delete('/excluir/{id}', [Setores::class, 'destroy'])->name('sistema.usuario.setores.excluir');
        });

        Route::prefix('/cargos')->group(function () {
            Route::get('/', [Cargos::class, 'index'])->name('sistema.usuario.cargos.entrar');
            Route::get('/criar', [Cargos::class, 'create'])->name('sistema.usuario.cargos.criar');
            Route::post('/cadastrar', [Cargos::class, 'store'])->name('sistema.usuario.cargos.cadastrar');
            Route::get('/editar/{id}', [Cargos::class, 'edit'])->name('sistema.usuario.cargos.editar');
            Route::put('/atualizar/{id}', [Cargos::class, 'update'])->name('sistema.usuario.cargos.atualizar');
            Route::delete('/excluir/{id}', [Cargos::class, 'destroy'])->name('sistema.usuario.cargos.excluir');
        });

        Route::prefix('/colaboradores')->group(function () {
            Route::get('/', [Colaboradores::class, 'index'])->name('sistema.usuario.colaboradores.entrar');
            Route::get('/criar', [Colaboradores::class, 'create'])->name('sistema.usuario.colaboradores.criar');
            Route::post('/cadastrar', [Colaboradores::class, 'store'])->name('sistema.usuario.colaboradores.cadastrar');
            Route::get('/editar/{id}', [Colaboradores::class, 'edit'])->name('sistema.usuario.colaboradores.editar');
            Route::put('/atualizar/{id}', [Colaboradores::class, 'update'])->name('sistema.usuario.colaboradores.atualizar');
            Route::delete('/excluir/{id}', [Colaboradores::class, 'destroy'])->name('sistema.usuario.colaboradores.excluir');
        });

        Route::prefix('/financeiros')->group(function () {
            Route::get('/', [Financeiros::class, 'index'])->name('sistema.usuario.financeiros.entrar');
            Route::get('/criar', [Financeiros::class, 'create'])->name('sistema.usuario.financeiros.criar');
            Route::post('/cadastrar', [Financeiros::class, 'store'])->name('sistema.usuario.financeiros.cadastrar');
            Route::get('/editar/{id}', [Financeiros::class, 'edit'])->name('sistema.usuario.financeiros.editar');
            Route::put('/atualizar/{id}', [Financeiros::class, 'update'])->name('sistema.usuario.financeiros.atualizar');
            Route::delete('/excluir/{id}', [Financeiros::class, 'destroy'])->name('sistema.usuario.financeiros.excluir');
        });

    });
});

require __DIR__ . '/auth.php';