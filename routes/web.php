<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\PharmacyController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\ShiftController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();


//
//
//  admin prefix in RouteServiceProvider
//
//



Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard', [HomeController::class, 'index'])->name('admin');



// shifts Route
Route::group(['prefix' => 'shifts', 'middleware' => 'auth'], function () {
    $permission = 'shifts';
    Route::get('/', [ShiftController::class, 'index'])->name('shifts')->middleware('permission:read-' . $permission);
    Route::get('create', [ShiftController::class, 'create'])->name('shifts.create')->middleware('permission:create-' . $permission);
    Route::post('store', [ShiftController::class, 'store'])->name('shifts.store')->middleware('permission:create-' . $permission);
    Route::get('edit/{id}', [ShiftController::class, 'edit'])->name('shifts.edit')->middleware('permission:update-' . $permission);
    Route::post('update/{id}', [ShiftController::class, 'update'])->name('shifts.update')->middleware('permission:update-' . $permission);
    Route::get('delete/{id}', [ShiftController::class, 'delete'])->name('shifts.delete')->middleware('permission:delete-' . $permission);
    Route::post('deletes', [ShiftController::class, 'deletes'])->name('shifts.deletes')->middleware('permission:delete-' . $permission);
});


// users Route
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    $permission = 'users';
    Route::get('/', [UserController::class, 'index'])->name('users')->middleware('permission:read-' . $permission);
    Route::get('show/{id}', [UserController::class, 'show'])->middleware('permission:create-' . $permission);
    Route::post('change_status', [UserController::class, 'change_status'])->name('users.change_status');
    Route::get('create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create-' . $permission);
    Route::post('store', [UserController::class, 'store'])->name('users.store')->middleware('permission:create-' . $permission);
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:update-' . $permission);
    Route::post('update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('permission:update-' . $permission);
    Route::post('deletes', [UserController::class, 'deletes'])->name('users.deletes')->middleware('permission:delete-' . $permission);
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('users.delete')->middleware('permission:delete-' . $permission);

    //userShifts
    Route::get('shifts/{id}', [UserController::class, 'indexShifts'])->name('users.shifts')->middleware('permission:read-' . $permission);

});

// pharmacies Route
Route::group(['prefix' => 'pharmacies', 'middleware' => 'auth'], function () {
    $permission = 'pharmacies';
    Route::get('/', [PharmacyController::class, 'index'])->name('pharmacies')->middleware('permission:read-' . $permission);
    Route::get('create', [PharmacyController::class, 'create'])->name('pharmacies.create')->middleware('permission:create-' . $permission);
    Route::post('store', [PharmacyController::class, 'store'])->name('pharmacies.store')->middleware('permission:create-' . $permission);
    Route::get('edit/{id}', [PharmacyController::class, 'edit'])->name('pharmacies.edit')->middleware('permission:update-' . $permission);
    Route::post('update/{id}', [PharmacyController::class, 'update'])->name('pharmacies.update')->middleware('permission:update-' . $permission);
    Route::get('delete/{id}', [PharmacyController::class, 'delete'])->name('pharmacies.delete')->middleware('permission:delete-' . $permission);
    Route::post('deletes', [PharmacyController::class, 'deletes'])->name('pharmacies.deletes')->middleware('permission:delete-' . $permission);

    //pharmacyShifts
    Route::get('shifts/{id}', [PharmacyController::class, 'indexShifts'])->name('pharmacies.shifts')->middleware('permission:read-' . $permission);
});

// admins Route
Route::group(['prefix' => 'admins', 'middleware' => 'auth'], function () {
    $permission = 'admins';
    Route::get('/', [AdminController::class, 'index'])->name('admins')->middleware('permission:read-' . $permission);
    Route::get('create', [AdminController::class, 'create'])->name('admins.create')->middleware('permission:create-' . $permission);
    Route::post('store', [AdminController::class, 'store'])->name('admins.store')->middleware('permission:create-' . $permission);
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admins.edit')->middleware('permission:update-' . $permission);
    Route::post('update/{id}', [AdminController::class, 'update'])->name('admins.update')->middleware('permission:update-' . $permission);
    Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admins.delete')->middleware('permission:delete-' . $permission);
    Route::post('deletes', [AdminController::class, 'deletes'])->name('admins.deletes')->middleware('permission:delete-' . $permission);

});
// roles Route
Route::group(['prefix' => 'roles', 'middleware' => 'auth'], function () {
    $permission = 'roles';
    Route::get('/', [RoleController::class, 'index'])->name('roles')->middleware('permission:read-' . $permission);
    Route::get('create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create-' . $permission);
    Route::post('store', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create-' . $permission);
    Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:update-' . $permission);
    Route::post('update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:update-' . $permission);
    Route::post('deletes', [RoleController::class, 'deletes'])->name('roles.deletes')->middleware('permission:delete-' . $permission);
    Route::get('delete/{id}', [RoleController::class, 'delete'])->name('roles.delete')->middleware('permission:delete-' . $permission);
});


//settings
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', [SettingController::class, 'index'])->name('settings');
    Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
});
