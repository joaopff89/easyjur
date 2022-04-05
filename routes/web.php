<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/dica/create', [HomeController::class, 'dicaCreate'])->name('dica.create');
    Route::get('/dica/edit/{id}', [HomeController::class, 'dicaEdit'])->name('dica.edit');
    Route::get('/dica/{id}', [HomeController::class, 'dicaShow'])->name('dica.show');
});
