<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\Charging\Controllers\ChargerEventController;

Route::middleware('api')->prefix('charger-events')->group(function () {
    Route::post('/session-started', [ChargerEventController::class, 'sessionStarted']);
    Route::post('/meter-updated', [ChargerEventController::class, 'meterUpdated']);
    Route::post('/session-ended', [ChargerEventController::class, 'sessionEnded']);
});
