<?php

use App\Events\UserRegister;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionContrller;
use App\Models\User;
use App\Models\Userss;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => '/'], function () {
    Route::post('/login',  [LoginController::class, 'login']);
    Route::get('/login',  function () {
        return View("welcome");
    });
    Route::get('/fireEvent',  function () {
        return View("fireEvent");
    });
    Route::post('/fireEvent',  function () {
        $name = request()->name;
        event(new UserRegister($name));
        return View("fireEvent");
    });
});
Route::group(['prefix' => '/dashboard'], function () {
    Route::group(['prefix' => '/userPermission'], function () {
        Route::post('/setPermissionForUser',  [UserPermissionContrller::class, 'setPermissionForUser']);
        Route::post('/updatePermissionForUser',  [UserPermissionContrller::class, 'updatePermissionForUser']);
        Route::post('/getPermissionForUser',  [UserPermissionContrller::class, 'getPermissionForUser']);
    });
    Route::group(['prefix' => '/permissions'], function () {
        Route::post('/addPermission',  [PermissionController::class, 'addNewPermission']);
        Route::get('/getAllPermission',  [PermissionController::class, 'getAllPermission']);
        Route::post('/addNewActionForPagePermission',  [PermissionController::class, 'addNewActionForPagePermission']);
    });
    Route::post('/register',  [RegisterController::class, 'addNewUser']);
    Route::post('/logOut',  [LogOutController::class, 'logOut']);
});
