<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('users', UserController::class);
    //Route::get('users/{user}/edit-roles', [UserController::class, 'editRoles'])->name('users.editRoles');
    //Route::put('users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');

    //Route::resource('roles', RoleController::class);
    //Route::resource('permissions', PermissionController::class);

    Route::resource('projects', ProjectController::class);

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
