<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\ChargingInfrastructure\Controllers\ChargingPointController;

Route::middleware('api')->prefix('charging-points')->group(function () {
    Route::get('/', [ChargingPointController::class, 'index']);
    Route::get('/{chargingPoint}', [ChargingPointController::class, 'show']);
    Route::post('/', [ChargingPointController::class, 'store']);
    Route::put('/{chargingPoint}', [ChargingPointController::class, 'update']);
    Route::delete('/{chargingPoint}', [ChargingPointController::class, 'destroy']);
});
