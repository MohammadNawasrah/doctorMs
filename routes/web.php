<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\LogOutController;
use App\Http\Controllers\Dashboard\Patient\PatientController;
use App\Http\Controllers\Dashboard\Patient\PatientRecordController;
use App\Http\Controllers\Dashboard\Auth\PermissionController;
use App\Http\Controllers\Dashboard\Auth\RegisterController;
use App\Http\Controllers\Dashboard\Auth\UserPermissionContrller;
use App\Http\Controllers\Dashboard\Auth\UsersController;
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

Route::fallback(function () {
    return redirect()->route('index');
})->name('fallback');

Route::group(['prefix' => '/'], function () {
    Route::post('/login',  [LoginController::class, 'login']);
    Route::get('/login',  [LoginController::class, 'loginAction'])->name("index");
    Route::get('/fireEvent',  function () {
        return View("fireEvent");
    });
});
Route::group(['prefix' => '/dashboard'], function () {
    users();
    userPermission();
    permissions();
    patients();
    patientRecords();
    Route::post('/logOut',  [LogOutController::class, 'logOut']);
});
function users()
{
    return
        Route::group(['prefix' => '/users'],  function () {
            Route::get('/',  function () {
                return View("users");
            });
            Route::post('/register',  [RegisterController::class, 'addNewUser']);
            Route::get('/getAllAdminUsers', [UsersController::class, 'getAllAdminUsers']);
            Route::post('/user/online', [UsersController::class, 'setSocketIdForUserOnline']);
            Route::post('/user/offline', [UsersController::class, 'setSocketIdForUserOffline']);
            Route::post('/user', [UsersController::class, 'getUserByUserName']);
        });
}
function userPermission()
{
    return
        Route::group(['prefix' => '/userPermission'], function () {
            Route::post('/setPermissionForUser',  [UserPermissionContrller::class, 'setPermissionForUser']);
            Route::post('/updatePermissionForUser',  [UserPermissionContrller::class, 'updatePermissionForUser']);
            Route::post('/getPermissionForUser',  [UserPermissionContrller::class, 'getPermissionForUser']);
        });
}
function permissions()
{
    return
        Route::group(['prefix' => '/permissions'], function () {
            Route::get('/',  function () {
                return View("permissions");
            });
            Route::post('/addPermission',  [PermissionController::class, 'addNewPermission']);
            Route::get('/getAllPermission',  [PermissionController::class, 'getAllPermission']);
            Route::post('/addNewActionForPagePermission',  [PermissionController::class, 'addNewActionForPagePermission']);
        });;
}
function patients()
{
    return
        Route::group(['prefix' => '/patients'], function () {
            Route::post('/',  [PatientController::class, 'showPatients']);
            Route::post('/patient',  [PatientController::class, 'showPatient']);
            Route::post('/patient/add',  [PatientController::class, 'addPatient']);
            Route::post('/patient/update',  [PatientController::class, 'updatePatient']);
            Route::post('/patient/delete',  [PatientController::class, 'deletePatient']);
        });
}
function patientRecords()
{
    return
        Route::group(['prefix' => '/patientRecords'], function () {
            Route::post('/',  [PatientRecordController::class, 'showRecords']);
            Route::post('/record',  [PatientRecordController::class, 'showRecord']);
            Route::post('/record/add',  [PatientRecordController::class, 'addRecord']);
            Route::post('/record/update',  [PatientRecordController::class, 'updateRecord']);
            Route::post('/record/delete',  [PatientRecordController::class, 'deleteRecord']);
        });
}
