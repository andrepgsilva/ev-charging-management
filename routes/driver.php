<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\Fleet\Controllers\DriverController;

Route::middleware('api')->prefix('drivers')->group(function () {
    Route::get('/', [DriverController::class, 'index']);
    Route::get('/{driver}', [DriverController::class, 'show']);
    Route::post('/', [DriverController::class, 'store']);
    Route::put('/{driver}', [DriverController::class, 'update']);
    Route::delete('/{driver}', [DriverController::class, 'destroy']);
});
