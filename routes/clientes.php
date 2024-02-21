<?php

use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clientes'], function () {
    Route::post('/', [ClientesController::class, 'store']);
    Route::get('/', [ClientesController::class, 'index']);
    Route::put('/{id}', [ClientesController::class, 'update']);
    Route::get('/{id}/edit', [ClientesController::class, 'edit']);
    Route::delete('/{id}/delete', [ClientesController::class, 'delete']);
    Route::get('/{id}/download', [ClientesController::class, 'downloadUserData']);
});
