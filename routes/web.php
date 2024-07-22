<?php

use App\Http\Controllers\Bc40Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth-logout');

    Route::get('/dashboard', [Bc40Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/bc40-import', [Bc40Controller::class, 'index'])->name('bc40-index');
    Route::get('/download_template', [Bc40Controller::class, 'download_template'])->name('download_template');
    Route::get('/browse', [Bc40Controller::class, 'browse'])->name('bc40-browse');

    Route::post('/bc40-import', [Bc40Controller::class, 'import'])->name('bc40-import');
    Route::post('/bc40-export', [Bc40Controller::class, 'export'])->name('bc40-export');
});

Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('auth-login');
Route::get('/login', function () {
    $token = request('token');
    if ($token) {
        list($user_id, $timestamp) = explode(':', base64_decode($token));
        $user = User::find($user_id);
        if ($user) {
            Auth::login($user);
            return redirect('/dashboard');
        }
    }
    return redirect('http://localhost:8080/sikimon_r/Home')->with('error', 'Invalid login token.');
});
