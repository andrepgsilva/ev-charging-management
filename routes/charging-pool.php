<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\ChargingInfrastructure\Controllers\ChargingPoolController;

Route::middleware('api')->prefix('charging-pools')->group(function () {
    Route::get('/', [ChargingPoolController::class, 'index']);
    Route::get('/{chargingPool}', [ChargingPoolController::class, 'show']);
    Route::post('/', [ChargingPoolController::class, 'store']);
    Route::put('/{chargingPool}', [ChargingPoolController::class, 'update']);
    Route::delete('/{chargingPool}', [ChargingPoolController::class, 'destroy']);
});
