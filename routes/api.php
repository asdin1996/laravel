<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\ContactController;

Route::prefix('v1')->group(function () {

    /*
        Public routes
    */

    Route::post('login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');

    Route::post('register', [AuthController::class, 'register'])
        ->middleware('throttle:5,1');

    /*
        Protected routes
    */

    Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {

        Route::get('user', [AuthController::class, 'user']);

        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('logout-all', [AuthController::class, 'logoutAll']);

        Route::apiResource('books', BookController::class);
        Route::apiResource('contacts', ContactController::class);
    });

});
