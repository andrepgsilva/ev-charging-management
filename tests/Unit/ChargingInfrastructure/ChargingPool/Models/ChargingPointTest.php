<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

uses(DatabaseMigrations::class);

it('to array', function () {
    $chargingPoint = ChargingPoint::factory()->createOne();

    expect(array_keys($chargingPoint->toArray()))
        ->toEqual([
            'label',
            'vendor',
            'serial_number',
            'description',
            'charging_pool_id',
            'updated_at',
            'created_at',
            'id',
        ]);
});

it('if charging pool belongs to a company', function () {
    $chargingPoint = ChargingPoint::factory()->createOne();

    expect($chargingPoint->chargingPool)->toBeInstanceOf(ChargingPool::class);
});
