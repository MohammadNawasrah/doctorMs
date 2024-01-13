<?php
// web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\HtmlCodeController;
use App\Http\Controllers\Dashboard\Auth\LogOutController;
use App\Http\Controllers\Dashboard\UploadImageController;
use App\Http\Controllers\Dashboard\Patient\PatientController;
use App\Http\Controllers\Dashboard\Patient\PatientRecordController;
use App\Http\Controllers\Dashboard\Auth\PermissionController;
use App\Http\Controllers\Dashboard\Auth\RegisterController;
use App\Http\Controllers\Dashboard\Auth\UserPermissionContrller;
use App\Http\Controllers\Dashboard\Auth\UsersController;
use App\Http\Controllers\Dashboard\Patient\PatientAppointmentController;
use App\Http\Controllers\Dashboard\Patient\PatientToDoctorController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Route;
use Trait\Helpers\SessionHelper;

Route::fallback(fn () => redirect()->route('index'))->name('fallback');

Route::group(['prefix' => '/'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/login', [LoginController::class, 'index'])->name('index');
});

Route::group(['prefix' => '/dashboard'],  function () {
    Route::get('/dateToDay', function () {
        return View('dateToDay');
    });
    Route::get('/doctor', function () {
        return View('doctorPage');
    });
    Route::get('/image/profile/getUserProfileImage', [UploadImageController::class, 'getUserProfileImage']);
    Route::post('/image/profile/add', [UploadImageController::class, 'uploadProfileImage']);
    Route::post('/image/patient/show', [UploadImageController::class, 'getAllImgeToPatient']);
    Route::post('/image/patient/add', [UploadImageController::class, 'uploadProfileImageForPatient']);
    Route::post('/userPageToAccess', [UsersController::class, 'getUserPageAllowToAccess']);
    Route::get('/', function () {
        return SessionHelper::checkIfLogedinForView('layouts.dashboard');
    })->name('dashboard');
    Route::group(['prefix' => '/htmlCodePage'], function () {
        Route::get('/', [HtmlCodeController::class, 'index']);

        Route::post('/getAllHtmlCode', [HtmlCodeController::class, 'getAllHtmlCode']);
        Route::post('/updateHtmlCode', [HtmlCodeController::class, 'updateHtmlCode']);
    });
    Route::group(['prefix' => '/users'], function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::post('/register', [RegisterController::class, 'addNewUser']);
        Route::get('/getAllAdminUsers', [UsersController::class, 'getAllAdminUsers']);
        Route::post('/user/online', [UsersController::class, 'setSocketIdForUserOnline']);
        Route::post('/user/type/add', [UsersController::class, 'addType']);
        Route::post('/user/offline', [UsersController::class, 'setSocketIdForUserOffline']);
        Route::post('/user', [UsersController::class, 'getUserByUserName']);
        Route::post('/user/delete', [UsersController::class, 'deleteUser']);
        Route::post('/getUserPermissions', [UsersController::class, 'getUserPermissions']);
        Route::post('/getHtmlByPermission', [UsersController::class, 'getHtmlByPermission']);
        Route::post('/getUsersType', [UsersController::class, 'getUsersType']);
    });
    Route::group(['prefix' => '/userPermission'], function () {
        Route::post('/setPermissionForUser', [UserPermissionContrller::class, 'setPermissionForUser']);
        Route::post('/updatePermissionForUser', [UserPermissionContrller::class, 'updatePermissionForUser']);
        Route::post('/getPermissionForUser', [UserPermissionContrller::class, 'getPermissionForUser']);
    });
    Route::group(['prefix' => '/permissions'], function () {
        Route::get('/', [PermissionController::class, "index"]);
        Route::post('/addPermission', [PermissionController::class, 'addNewPermission']);
        Route::get('/getAllPermission', [PermissionController::class, 'getAllPermission']);
        Route::post('/addNewActionForPagePermission', [PermissionController::class, 'addNewActionForPagePermission']);
        Route::post('/getHtmlByPermission', [PermissionController::class, 'getHtmlByPermission']);
    });

    Route::group(['prefix' => '/patients'], function () {
        Route::get('/', [PatientController::class, 'index']);
        Route::post('/', [PatientController::class, 'showPatients']);
        Route::post('/patient', [PatientController::class, 'showPatient']);
        Route::post('/patient/add', [PatientController::class, 'addPatient']);
        Route::post('/patient/update', [PatientController::class, 'updatePatient']);
        Route::post('/patient/delete', [PatientController::class, 'deletePatient']);
    });
    Route::group(['prefix' => '/patientRecords'], function () {
        Route::post('/', [PatientRecordController::class, 'showRecords']);
        Route::get('/record/{token}', [PatientRecordController::class, 'fullRecord']);
        Route::post('/record', [PatientRecordController::class, 'getAllRecordForPatient']);
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
        Route::post('/', [PatientToDoctorController::class, 'showPatientsToAllDoctors']);
        Route::post('/showToDoctor', [PatientToDoctorController::class, 'showPatientsToDoctor']);
        Route::post('/toDoctor/add', [PatientToDoctorController::class, 'addtoDoctor']);
        Route::post('/toDoctor/update', [PatientToDoctorController::class, 'updatetoDoctor']);
        Route::post('/toDoctor/delete', [PatientToDoctorController::class, 'deletetoDoctor']);
    });
    Route::group(['prefix' => '/payment'], function () {
        Route::post('/addPaymnet', [PaymentsController::class, 'addPaymentForPatient']);
    });
    Route::get('/logOut', [LogOutController::class, 'logOut'])->name("logOut");
});
