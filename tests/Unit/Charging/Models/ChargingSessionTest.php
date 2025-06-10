<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

uses(DatabaseMigrations::class);

it('to array', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    expect(array_keys($chargingSession->toArray()))
        ->toEqual([
            'charging_point_id',
            'vehicle_id',
            'driver_id',
            'start_time',
            'end_time',
            'energy_kwh',
            'cost',
            'connector_number',
            'updated_at',
            'created_at',
            'id',
        ]);
});

it('belongs to a driver', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    expect($chargingSession->driver)->toBeInstanceOf(Driver::class);
});

it('belongs to a vehicle', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    expect($chargingSession->vehicle)->toBeInstanceOf(Vehicle::class);
});

it('belongs to a charging point', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    expect($chargingSession->chargingPoint)->toBeInstanceOf(ChargingPoint::class);
});
