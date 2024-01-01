<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPermissionContrller;
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

Route::post('/login',  [LoginController::class, 'login']);
Route::post('/register',  [RegisterController::class, 'addNewUser']);
Route::post('/logOut',  [LogOutController::class, 'logOut']);
Route::post('/addPermission',  [PermissionController::class, 'addNewPermission']);
Route::get('/getAllPermission',  [PermissionController::class, 'getAllPermission']);
Route::post('/addNewActionForPagePermission',  [PermissionController::class, 'addNewActionForPagePermission']);
Route::post('/setPermissionForUser',  [UserPermissionContrller::class, 'setPermissionForUser']);
Route::post('/updatePermissionForUser',  [UserPermissionContrller::class, 'updatePermissionForUser']);
