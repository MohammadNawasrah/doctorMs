<?php
// web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\LogOutController;
use App\Http\Controllers\Dashboard\Patient\PatientController;
use App\Http\Controllers\Dashboard\Patient\PatientRecordController;
use App\Http\Controllers\Dashboard\Auth\PermissionController;
use App\Http\Controllers\Dashboard\Auth\RegisterController;
use App\Http\Controllers\Dashboard\Auth\UserPermissionContrller;
use App\Http\Controllers\Dashboard\Auth\UsersController;
use App\Http\Controllers\Dashboard\Patient\PatientAppointmentController;
use App\Http\Controllers\Dashboard\Patient\PatientToDoctorController;
use Illuminate\Support\Facades\Route;

Route::fallback(fn () => redirect()->route('index'))->name('fallback');

Route::group(['prefix' => '/'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/login', [LoginController::class, 'loginAction'])->name('index');
    Route::get('/fireEvent', fn () => view('fireEvent'));
});

Route::group(['prefix' => '/dashboard'],  function () {
    Route::group(['prefix' => '/users'], function () {
        Route::get('/', fn () => view('users'));
        Route::post('/register', [RegisterController::class, 'addNewUser']);
        Route::get('/getAllAdminUsers', [UsersController::class, 'getAllAdminUsers']);
        Route::post('/user/online', [UsersController::class, 'setSocketIdForUserOnline']);
        Route::post('/user/offline', [UsersController::class, 'setSocketIdForUserOffline']);
        Route::post('/user', [UsersController::class, 'getUserByUserName']);
    });
    Route::group(['prefix' => '/userPermission'], function () {
        Route::post('/setPermissionForUser', [UserPermissionContrller::class, 'setPermissionForUser']);
        Route::post('/updatePermissionForUser', [UserPermissionContrller::class, 'updatePermissionForUser']);
        Route::post('/getPermissionForUser', [UserPermissionContrller::class, 'getPermissionForUser']);
    });
    Route::group(['prefix' => '/permissions'], function () {
        Route::get('/', fn () => view('permissions'));
        Route::post('/addPermission', [PermissionController::class, 'addNewPermission']);
        Route::get('/getAllPermission', [PermissionController::class, 'getAllPermission']);
        Route::post('/addNewActionForPagePermission', [PermissionController::class, 'addNewActionForPagePermission']);
    });
    Route::group(['prefix' => '/patients'], function () {
        Route::post('/', [PatientController::class, 'showPatients']);
        Route::post('/patient', [PatientController::class, 'showPatient']);
        Route::post('/patient/add', [PatientController::class, 'addPatient']);
        Route::post('/patient/update', [PatientController::class, 'updatePatient']);
        Route::post('/patient/delete', [PatientController::class, 'deletePatient']);
    });
    Route::group(['prefix' => '/patientRecords'], function () {
        Route::post('/', [PatientRecordController::class, 'showRecords']);
        Route::post('/record', [PatientRecordController::class, 'showRecord']);
        Route::post('/record/add', [PatientRecordController::class, 'addRecord']);
        Route::post('/record/update', [PatientRecordController::class, 'updateRecord']);
        Route::post('/record/delete', [PatientRecordController::class, 'deleteRecord']);
    });
    Route::group(['prefix' => '/patientAppointments'], function () {
        Route::post('/', [PatientAppointmentController::class, 'showAppointments']);
        Route::post('/appointment', [PatientAppointmentController::class, 'showAppointment']);
        Route::post('/appointment/add', [PatientAppointmentController::class, 'addAppointment']);
        Route::post('/appointment/update', [PatientAppointmentController::class, 'updateAppointment']);
        Route::post('/appointment/delete', [PatientAppointmentController::class, 'deleteAppointment']);
        Route::post('/appointment/haveAppoinntment', [PatientAppointmentController::class, 'patientsHaveAppoinntment']);
    });
    Route::group(['prefix' => '/patientsToDoctor'], function () {
        Route::post('/', [PatientToDoctorController::class, 'showtoDoctors']);
        Route::post('/toDoctor', [PatientToDoctorController::class, 'showtoDoctor']);
        Route::post('/toDoctor/add', [PatientToDoctorController::class, 'addtoDoctor']);
        Route::post('/toDoctor/update', [PatientToDoctorController::class, 'updatetoDoctor']);
        Route::post('/toDoctor/delete', [PatientToDoctorController::class, 'deletetoDoctor']);
    });
    Route::post('/logOut', [LogOutController::class, 'logOut']);
});
