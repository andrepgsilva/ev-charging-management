<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VehicleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{company}', [CompanyController::class, 'show']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::put('/{company}', [CompanyController::class, 'update']);
    Route::delete('/{company}', [CompanyController::class, 'destroy']);
});

Route::middleware('api')->prefix('drivers')->group(function () {
    Route::get('/', [DriverController::class, 'index']);
    Route::get('/{driver}', [DriverController::class, 'show']);
    Route::post('/', [DriverController::class, 'store']);
    Route::put('/{driver}', [DriverController::class, 'update']);
    Route::delete('/{driver}', [DriverController::class, 'destroy']);
});

Route::middleware('api')->prefix('vehicles')->group(function () {
    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/{vehicle}', [VehicleController::class, 'show']);
    Route::post('/', [VehicleController::class, 'store']);
    Route::put('/{vehicle}', [VehicleController::class, 'update']);
    Route::delete('/{vehicle}', [VehicleController::class, 'destroy']);
});
