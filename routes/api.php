<?php

use App\Http\Controllers\System\DashboardsController as Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/dashboards')->group(function (){
        Route::get('/popularGraficos', [Dashboard::class, 'informacoes_para_popular_graficos'])->name('api.dashboards.informacoes_para_popular_graficos');
    });
});