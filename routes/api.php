<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CompanyController;
use App\Http\Controllers\API\V1\LgaController;
use App\Http\Controllers\API\V1\PlateNumberController;
use App\Http\Controllers\API\V1\PlateNumberOrderController;
use App\Http\Controllers\API\V1\StateController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/password-change', [AuthController::class, 'password_change'])->name('password_change');
        
        Route::apiResource('users', UserController::class);
        Route::apiResource('companies', CompanyController::class);
        Route::apiResource('states', StateController::class);
        Route::apiResource('lgas', LgaController::class);
        Route::apiResource('plate_numbers', PlateNumberController::class);
        Route::apiResource('plate_number_orders', PlateNumberOrderController::class);
    });

    Route::middleware(['api-key'])->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/reset-password', [AuthController::class, 'send_temporary_password'])->name('send_temporary_password');
        Route::post('/reset-password-link', [AuthController::class, 'reset_password'])->name('password.reset');
    });
});