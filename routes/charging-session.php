<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\Charging\Controllers\ChargingSessionController;

Route::middleware('api')->prefix('charging-sessions')->group(function () {
    Route::get('/', [ChargingSessionController::class, 'index']);
    Route::get('/{chargingSession}', [ChargingSessionController::class, 'show']);
    Route::post('/', [ChargingSessionController::class, 'store']);
    Route::put('/{chargingSession}', [ChargingSessionController::class, 'update']);
    Route::delete('/{chargingSession}', [ChargingSessionController::class, 'destroy']);
});
