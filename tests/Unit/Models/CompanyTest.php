<?php

declare(strict_types=1);

use App\Models\Driver;
use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('to array', function () {
    $company = Company::factory()->createOne();

    expect(array_keys($company->toArray()))
        ->toEqual([
            'name',
            'email',
            'tax_number',
            'phone',
            'address',
            'updated_at',
            'created_at',
            'id',
        ]);
});

test('if company has drivers', function () {
    $company = Company::factory()->createOne();
    Driver::factory()->createOne([
        'company_id' => $company->id,
    ]);

    expect($company->drivers)->toBeInstanceOf(Collection::class);
});

test('if company has vehicles', function () {
    $company = Company::factory()->createOne();

    expect($company->vehicles)->toBeInstanceOf(Collection::class);
});
