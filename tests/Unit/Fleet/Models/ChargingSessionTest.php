<?php

declare(strict_types=1);

use App\Models\ChargingSession;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

test('to array', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    expect(array_keys($chargingSession->toArray()))
        ->toEqual([
            'company_id',
            'vehicle_id',
            'driver_id',
            'location_id',
            'start_time',
            'end_time',
            'energy_kwh',
            'status',
            'updated_at',
            'created_at',
            'id',
        ]);
});
