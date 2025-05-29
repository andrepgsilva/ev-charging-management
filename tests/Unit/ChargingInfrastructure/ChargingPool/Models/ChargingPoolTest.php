<?php

declare(strict_types=1);

use App\Modules\Company\Models\Company;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;

uses(DatabaseMigrations::class);

it('to array', function () {
    $chargingPool = ChargingPool::factory()->createOne();

    expect(array_keys($chargingPool->toArray()))
        ->toEqual([
            'name',
            'address',
            'country',
            'state',
            'city',
            'postal_code',
            'latitude',
            'longitude',
            'type',
            'description',
            'company_id',
            'updated_at',
            'created_at',
            'id',
        ]);
});

it('if charging pool belongs to a company', function () {
    $chargingPool = ChargingPool::factory()->createOne();

    expect($chargingPool->company)->toBeInstanceOf(Company::class);
});
