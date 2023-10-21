<?php

use App\Http\Controllers\System\DashboardsController as Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\User\BeneficiosController as Beneficios;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboards/popularGraficos', [Dashboard::class, 'informacoes_para_popular_graficos'])->name('api.dashboards.informacoes_para_popular_graficos');
});