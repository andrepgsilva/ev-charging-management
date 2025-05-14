<?php

declare(strict_types=1);

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

test('to array', function () {
    $vehicle = Vehicle::factory()->createOne();

    expect(array_keys($vehicle->toArray()))
        ->toEqual([
            'make',
            'model',
            'plate_number',
            'battery_capacity_kwh',
            'driver_id',
            'company_id',
            'updated_at',
            'created_at',
            'id',
        ]);
});

test('if vehicle belongs to a driver', function () {
    $vehicle = Vehicle::factory()->createOne();

    expect($vehicle->driver)->toBeInstanceOf(App\Models\Driver::class);
});

test('if vehicle belongs to a company', function () {
    $vehicle = Vehicle::factory()->createOne();

    expect($vehicle->company)->toBeInstanceOf(App\Models\Company::class);
});
