<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\Fleet\Controllers\VehicleController;

Route::middleware('api')->prefix('vehicles')->group(function () {
    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/{vehicle}', [VehicleController::class, 'show']);
    Route::post('/', [VehicleController::class, 'store']);
    Route::put('/{vehicle}', [VehicleController::class, 'update']);
    Route::delete('/{vehicle}', [VehicleController::class, 'destroy']);
});
