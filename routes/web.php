<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::post('/bc40-import', [\App\Http\Controllers\Bc40Controller::class, 'import'])->name('bc40-import');

Route::get('/bc40-import', [\App\Http\Controllers\Bc40Controller::class, 'index'])->name('bc40-index');

Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth-login');
