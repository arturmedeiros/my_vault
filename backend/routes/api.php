<?php

use App\Helpers\HelperClass;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PasswordController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\RoleUserController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\VaultTypeController;
use Illuminate\Support\Facades\Route;

// API Running
Route::get('', [HelperClass::class, 'checkAPIStatus']);

// API V1 - UNAUTHORIZED
Route::get('unauthorized', function (){
    return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
})->name('api.unauthorized');

// API V1 - AUTHENTICATION
Route::prefix('v1/auth')->name('api.v1.auth.')->group(function () {
    /* Login */
    Route::post('login',  [AuthController::class, 'login'])->name('login');
    /* Logout */
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    /* Me (User Logged) */
    Route::post('me',     [AuthController::class, 'me'])->name('me');
});

// API V1 - PROTECTED GROUP
Route::group(['middleware' => 'auth:api'], function () {
    Route::prefix('v1')->name('api.v1.')->group(function () {
        /* Admin */
        Route::prefix('admin')->name('api.v1.')->group(function () {
            /* Users */
            Route::apiResource('users', UserController::class)->except(['show', 'update', 'destroy']);
            Route::get('users/{key}', [UserController::class, 'show'])->name('users.show');
            Route::put('users', [UserController::class, 'update'])->name('users.update');
            Route::delete('users', [UserController::class, 'destroy'])->name('users.destroy');

            /* Roles */
            Route::apiResource('roles', RoleController::class);
            Route::apiResource('role/user', RoleUserController::class)->except('index');
            Route::get('roles_users', [RoleUserController::class, 'index']);
        });

        /* Vault */
        Route::prefix('vault')->name('api.v1.')->group(function () {
            /* Types */
            Route::apiResource('types', VaultTypeController::class);
            /* Passwords */
            Route::apiResource('pass', PasswordController::class);
        });
    });
});
