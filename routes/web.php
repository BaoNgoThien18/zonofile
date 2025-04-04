<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SubcriptionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CronJobController;

use Illuminate\Support\Facades\Route;


Route::get('files', function () {
    return view('frontend.pages.files');
});

// Route group với middleware 'checklogin'
Route::middleware(['checklogin'])->group(function () {

    // CLIENT
    Route::get('/', [HomeController::class, 'index']);

    Route::resource('file', FileController::class);
    Route::resource('folder', FolderController::class)->except(['show']);


    Route::get('/file', [FileController::class, 'indexClient']);
    Route::get('/folder/{id}', [FolderController::class, 'indexClient']);

    Route::get('/upgrade', [PackageController::class, 'indexClient'])->name('upgrade');
    Route::get('payment/createOrder/Vnpay', [PaymentController::class, 'createOrderVnpay']);
    Route::get('payment/return/Vnpay', [PaymentController::class, 'paymentReturnVnpay']);

    Route::get('/recent', [FileController::class, 'recent']);
    Route::get('/trash', [FileController::class, 'trash']);


    // -- UPDATE: PROFILE
    Route::get('/profile', [UserController::class, 'profileClient'])->name('profile');
    Route::post('/user/updateProfile', [UserController::class, 'updateProfile']);

    Route::get('/topup', function () {
        return view('frontend.profile.topup');
    });
    Route::get('/notification', function () {
        return view('frontend.profile.notification');
    });
    Route::get('/setting', function () {
        return view('frontend.profile.setting');
    });



    Route::get('cronJob-removeFile', [CronJobController::class, 'removeFile']);
    Route::post('getFile', [Filecontroller::class, 'getFile']);
    Route::post('getRuleFile', [Filecontroller::class, 'getRuleFile']);
    Route::post('renameFile', [Filecontroller::class, 'renameFile']);
    Route::post('searchFile', [Filecontroller::class, 'searchFile']);
    Route::post('removeFile', [Filecontroller::class, 'removeFile']);
    Route::post('removeAllFile', [Filecontroller::class, 'removeAllFile']);
    Route::post('restoreFile', [Filecontroller::class, 'restoreFile']);
    Route::post('shareFileToMail', [Filecontroller::class, 'shareFileToMail']);
    Route::post('updateRuleFile', [Filecontroller::class, 'updateRuleFile']);
    





});

Route::get('/shared/{id}', [Filecontroller::class, 'shared']);
Route::get('/download/{id}', [FileController::class, 'downloadFile']);

// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password.form');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot-password.send');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password.update');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ADMIN
Route::middleware(['checkAdmin'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'showDashboardPage']);
    Route::get('admin/themes', [AdminController::class, 'showThemesPage']);
    Route::get('admin/topups', [AdminController::class, 'showTopupsPage']);
    Route::resource('admin/logs', LogController::class);
    Route::resource('admin/settings', SettingController::class);
    Route::resource('admin/packages', PackageController::class);
    Route::resource('admin/files', FileController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/subscriptions', SubcriptionController::class);

    // ADMIN POST
    Route::post('settings/updateAllSetting', [SettingController::class, 'updateAllSetting'])->name('settings.updateAllSetting');
    Route::post('settings/saveThemes', [AdminController::class, 'saveThemes'])->name('settings.saveThemes');
});