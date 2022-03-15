<?php


use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Auth\AuthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('cache', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'success';
});

Route::get('/', function () {
    return redirect()->route('user.login.page');
})->name('landing');

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('user.login.page');
Route::post('/login/user', [AuthController::class, 'postLogin'])->name('user.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'auth:user', 'prefix' => 'user'], function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('user.home');
});
