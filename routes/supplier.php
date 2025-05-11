<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::prefix('supplier')->group(function () {
    Route::get('login', [SupplierAuthController::class, 'showLoginForm'])->name('supplier.login');
    Route::post('login', [SupplierAuthController::class, 'login']);
    Route::post('logout', [SupplierAuthController::class, 'logout'])->name('supplier.logout');

    Route::middleware('auth:supplier')->group(function () {
        Route::get('dashboard', fn () => Inertia::render('Supplier/Dashboard'));
    });
});