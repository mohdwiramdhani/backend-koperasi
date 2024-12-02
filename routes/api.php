<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/users/register', 'register');
        Route::post('/users/login', 'login');
    });

    Route::middleware('auth:api')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/users/current', 'getCurrentUser');
            Route::patch('/users/current', 'updateCurrentUser');

            // Route::middleware('role:admin')->group(function () {
            //     Route::get('/users', 'getAllUsers');
            // });

            Route::get('/users', 'getAllUsers')->middleware('role:admin');
            Route::delete('/users/{id}', 'deleteUser')->middleware('role:admin');
        });
    });

});
