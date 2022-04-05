<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DicaController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::get('/dica', [DicaController::class, 'index']);
Route::get('dica/{id}', [DicaController::class, 'show']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('dica', [DicaController::class, 'store']);
    Route::put('dica/{id}', [DicaController::class, 'update']);
    Route::delete('dica/{id}', [DicaController::class, 'destroy']);
});
