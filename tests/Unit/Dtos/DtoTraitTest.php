<?php

declare(strict_types=1);

use App\Models\Company;
use App\Dtos\Company\CreateCompanyDto;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('to array', function () {
    $company = Company::factory()->createOne();

    $companyDto = app(CreateCompanyDto::class, [
        'name' => $company->name,
        'email' => $company->email,
        'tax_number' => $company->tax_number,
        'phone' => $company->phone,
        'address' => $company->address,
    ]);

    expect($companyDto->toArray())
        ->toEqual([
            'name' => $company->name,
            'email' => $company->email,
            'tax_number' => $company->tax_number,
            'phone' => $company->phone,
            'address' => $company->address,
        ]);
});
