<?php

use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => "V1", 'namespace' => 'V1'], function () {
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
        Route::post('/register', [UserController::class, 'register']);
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/forget/password', [UserController::class, 'forget_password_code']);
    });

    Route::group(['middleware' => 'jwt.verify', 'prefix' => "user"], function () {
        Route::post('/logout', [UserController::class, 'logout']);

        //shift
        Route::get('/shifts', [ShiftController::class, 'shifts']);

    });
});
