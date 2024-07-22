<?php

use App\Http\Controllers\Bc40Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth-logout');

    Route::get('/dashboard', [Bc40Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/bc40-import', [Bc40Controller::class, 'index'])->name('bc40-index');
    Route::get('/download_template', [Bc40Controller::class, 'download_template'])->name('download_template');
    Route::get('/browse', [Bc40Controller::class, 'browse'])->name('bc40-browse');
    Route::post('/browse', [Bc40Controller::class, 'store'])->name('bc40-store');

    Route::post('/bc40-import', [Bc40Controller::class, 'import'])->name('bc40-import');
    Route::post('/bc40-export', [Bc40Controller::class, 'export'])->name('bc40-export');

    Route::get('/approval-bc40/{id}', [Bc40Controller::class, 'approval_index'])->name('approval-bc40.index');
    Route::put('/approval-bc40/{id}', [Bc40Controller::class, 'approval_status'])->name('approval-bc40.status');
    Route::delete('/approval-bc40/{id}', [Bc40Controller::class, 'approval_destroy'])->name('approval-bc40.destroy');
});

Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('auth-login');
