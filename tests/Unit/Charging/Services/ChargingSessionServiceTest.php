<?php

declare(strict_types=1);

use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\Charging\Services\ChargingSessionService;

uses(DatabaseMigrations::class);

it('retrieves a chargingSession by id', function () {
    ChargingSession::factory()->create(['connector_number' => 3]);

    /** @var ChargingSessionService $service */
    $service = app(ChargingSessionService::class);

    $chargingSession = $service->getById(1);

    expect($chargingSession)->not->toBeNull()
        ->and($chargingSession->connector_number)->toBe(3);
});
