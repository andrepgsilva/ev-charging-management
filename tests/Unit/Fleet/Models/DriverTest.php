<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use App\Modules\Company\Models\Company;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

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

    expect($driver->company_id)->toBe(1)
        ->and($driver->company)->toBeInstanceOf(Company::class);
});
