<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Company\Models\Company;
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

    expect($vehicle->driver)->toBeInstanceOf(Driver::class);
});

test('if vehicle belongs to a company', function () {
    $vehicle = Vehicle::factory()->createOne();

    expect($vehicle->company)->toBeInstanceOf(Company::class);
});
