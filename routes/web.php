<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\System\Admin\PerfisAcessoController as Perfis;
use App\Http\Controllers\System\DashboardsController as Dashboards;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\User\BeneficiosController as Beneficios;
use App\Http\Controllers\System\User\EmpresasController as Empresas;
use App\Http\Controllers\System\User\SetoresController as Setores;
use App\Http\Controllers\System\User\CargosController as Cargos;
use App\Http\Controllers\System\User\ColaboradoresController as Colaboradores;
use App\Http\Controllers\System\User\FinanceirosController as Financeiros;
use App\Http\Controllers\System\Admin\PerfisUsuariosController as PerfisUsuarios;
use App\Models\User;

Route::get('/', [Dashboards::class, 'home'])->name('dashboard')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/sistema')->middleware('auth')->group(function () {

    Route::prefix('/usuario')->group(function () {

        Route::prefix('/beneficios')->group(function () {
            Route::get('/', [Beneficios::class, 'index'])->name('sistema.usuario.beneficios.entrar')->middleware(['permission:' . User::VISUALIZAR_BENEFICIOS]);
            Route::get('/vincular-beneficio-usuario-view', [Beneficios::class, 'vincular_beneficio_usuario_view'])->name('sistema.usuario.beneficios.vincular_beneficio_usuario_view')->middleware(['permission:' . User::CADASTRAR_BENEFICIOS]);;
            Route::post('/vincular-beneficio-usuario-exe', [Beneficios::class, 'vincular_beneficio_usuario_exe'])->name('sistema.usuario.beneficios.vincular_beneficio_usuario_exe')->middleware(['permission:' . User::CADASTRAR_BENEFICIOS]);;
            Route::post('/desvincular-beneficio-usuario-exe', [Beneficios::class, 'desvincular_beneficio_usuario_exe'])->name('sistema.usuario.beneficios.desvincular_beneficio_usuario_exe')->middleware(['permission:' . User::EXCLUIR_BENEFICIOS]);;
        });

        Route::prefix('/empresa')->group(function () {
            Route::get('/', [Empresas::class, 'index'])->name('sistema.usuario.empresa.entrar')->middleware(['permission:' . User::VISUALIZAR_INFORMACOES_EMPRESA]);
            Route::put('/atualizar/{id}', [Empresas::class, 'update'])->name('sistema.usuario.empresa.atualizar')->middleware(['permission:' . User::ATUALIZAR_INFORMACOES_EMPRESA]);
        });

        Route::prefix('/setores')->group(function () {
            Route::get('/', [Setores::class, 'index'])->name('sistema.usuario.setores.entrar')->middleware(['permission:' . User::VISUALIZAR_SETORES]);
            Route::get('/criar', [Setores::class, 'create'])->name('sistema.usuario.setores.criar')->middleware(['permission:' . User::CADASTRAR_SETORES]);
            Route::post('/cadastrar', [Setores::class, 'store'])->name('sistema.usuario.setores.cadastrar')->middleware(['permission:' . User::CADASTRAR_SETORES]);
            Route::get('/editar/{id}', [Setores::class, 'edit'])->name('sistema.usuario.setores.editar')->middleware(['permission:' . User::EDITAR_SETORES]);
            Route::put('/atualizar/{id}', [Setores::class, 'update'])->name('sistema.usuario.setores.atualizar')->middleware(['permission:' . User::EDITAR_SETORES]);
            Route::delete('/excluir/{id}', [Setores::class, 'destroy'])->name('sistema.usuario.setores.excluir')->middleware(['permission:' . User::EXCLUIR_SETORES]);
        });

        Route::prefix('/cargos')->group(function () {
            Route::get('/', [Cargos::class, 'index'])->name('sistema.usuario.cargos.entrar')->middleware(['permission:' . User::VISUALIZAR_CARGOS]);
            Route::get('/criar', [Cargos::class, 'create'])->name('sistema.usuario.cargos.criar')->middleware(['permission:' . User::CADASTRAR_CARGOS]);
            Route::post('/cadastrar', [Cargos::class, 'store'])->name('sistema.usuario.cargos.cadastrar')->middleware(['permission:' . User::CADASTRAR_CARGOS]);
            Route::get('/editar/{id}', [Cargos::class, 'edit'])->name('sistema.usuario.cargos.editar')->middleware(['permission:' . User::EDITAR_CARGOS]);
            Route::put('/atualizar/{id}', [Cargos::class, 'update'])->name('sistema.usuario.cargos.atualizar')->middleware(['permission:' . User::EDITAR_CARGOS]);
            Route::delete('/excluir/{id}', [Cargos::class, 'destroy'])->name('sistema.usuario.cargos.excluir')->middleware(['permission:' . User::EXCLUIR_CARGOS]);
        });

        Route::prefix('/colaboradores')->group(function () {
            Route::get('/', [Colaboradores::class, 'index'])->name('sistema.usuario.colaboradores.entrar')->middleware(['permission:' . User::VISUALIZAR_COLABORADORES]);
            Route::get('/criar', [Colaboradores::class, 'create'])->name('sistema.usuario.colaboradores.criar')->middleware(['permission:' . User::CADASTRAR_COLABORADORES]);
            Route::post('/cadastrar', [Colaboradores::class, 'store'])->name('sistema.usuario.colaboradores.cadastrar')->middleware(['permission:' . User::CADASTRAR_COLABORADORES]);
            Route::get('/editar/{id}', [Colaboradores::class, 'edit'])->name('sistema.usuario.colaboradores.editar')->middleware(['permission:' . User::EDITAR_COLABORADORES]);
            Route::put('/atualizar/{id}', [Colaboradores::class, 'update'])->name('sistema.usuario.colaboradores.atualizar')->middleware(['permission:' . User::EDITAR_COLABORADORES]);
            Route::delete('/excluir/{id}', [Colaboradores::class, 'destroy'])->name('sistema.usuario.colaboradores.excluir')->middleware(['permission:' . User::EXCLUIR_COLABORADORES]);
        });

        Route::prefix('/financeiros')->group(function () {
            Route::get('/', [Financeiros::class, 'index'])->name('sistema.usuario.financeiros.entrar')->middleware(['permission:' . User::VISUALIZAR_FINANCEIROS]);
            Route::get('/criar', [Financeiros::class, 'create'])->name('sistema.usuario.financeiros.criar')->middleware(['permission:' . User::CADASTRAR_FINANCEIROS]);
            Route::post('/cadastrar', [Financeiros::class, 'store'])->name('sistema.usuario.financeiros.cadastrar')->middleware(['permission:' . User::CADASTRAR_FINANCEIROS]);
            Route::get('/editar/{id}', [Financeiros::class, 'edit'])->name('sistema.usuario.financeiros.editar')->middleware(['permission:' . User::EDITAR_FINANCEIROS]);
            Route::put('/atualizar/{id}', [Financeiros::class, 'update'])->name('sistema.usuario.financeiros.atualizar')->middleware(['permission:' . User::EDITAR_FINANCEIROS]);
            Route::delete('/excluir/{id}', [Financeiros::class, 'destroy'])->name('sistema.usuario.financeiros.excluir')->middleware(['permission:' . User::EXCLUIR_FINANCEIROS]);
        });
    });

    Route::prefix('/administrador')->group(function () {
        Route::prefix('/perfis_acesso')->group(function () {
            Route::get('/', [Perfis::class, 'index'])->name('system.admin.perfis.index')->middleware(['permission:' . User::VISUALIZAR_PERFIS_ACESSO]);
            Route::get('/criar', [Perfis::class, 'create'])->name('system.admin.perfis.create')->middleware(['permission:' . User::CADASTRAR_PERFIS_ACESSO]);
            Route::post('/inserir', [Perfis::class, 'store'])->name('system.admin.perfis.index.cadastrar')->middleware(['permission:' . User::CADASTRAR_PERFIS_ACESSO]);
            Route::get('/editar/{id}', [Perfis::class, 'edit'])->name('system.admin.perfis.editar')->middleware(['permission:' . User::EDITAR_PERFIS_ACESSO]);
            Route::put('/atualizar/{id}', [Perfis::class, 'update'])->name('system.admin.perfis.atualizar')->middleware(['permission:' . User::EDITAR_PERFIS_ACESSO]);
            Route::delete('/excluir/{id}', [Perfis::class, 'destroy'])->name('system.admin.perfis.excluir')->middleware(['permission:' . User::EXCLUIR_PERFIS_ACESSO]);
        });

        Route::prefix('/perfis_usuarios')->group(function (){
            Route::get('/', [PerfisUsuarios::class, 'index'])->name('system.admin.perfis.usuarios.index')->middleware(['permission:' . User::VISUALIZAR_PERFIS_USUARIOS]);
            Route::put('/atualizar/{id}', [PerfisUsuarios::class, 'edit'])->name('system.admin.perfis.usuarios.edit')->middleware(['permission:' . User::EDITAR_PERFIS_USUARIOS]);
        });
    });
});

require __DIR__ . '/auth.php';
