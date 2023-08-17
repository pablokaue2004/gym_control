<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/clientes', [ClientesController::class, 'store']);
Route::get('/clientes', [ClientesController::class, 'index']);
Route::put('/clientes/{id}', [ClientesController::class, 'update']); // Fixed
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit']); // Fixed
