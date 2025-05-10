<?php

declare(strict_types=1);

use App\Models\Driver;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('to array', function () {
    $driver = Driver::factory()->createOne();

    expect(array_keys($driver->toArray()))
        ->toEqual([
            'name',
            'email',
            'phone',
            'company_id',
            'updated_at',
            'created_at',
            'id',
        ]);
});

test('if driver belongs to a company', function () {
    $driver = Driver::factory()->createOne();
    expect($driver->company_id)->toBe(1);

    expect($driver->company)->toBeInstanceOf(Company::class);
});
