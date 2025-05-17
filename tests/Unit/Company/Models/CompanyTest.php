<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use App\Modules\Fleet\Models\Driver;
use App\Modules\Company\Models\Company;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('to array', function () {
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

it('if company has drivers', function () {
    $company = Company::factory()->createOne();
    Driver::factory()->createOne([
        'company_id' => $company->id,
    ]);

    expect($company->drivers)->toBeInstanceOf(Collection::class);
});

it('if company has vehicles', function () {
    $company = Company::factory()->createOne();

    expect($company->vehicles)->toBeInstanceOf(Collection::class);
});
