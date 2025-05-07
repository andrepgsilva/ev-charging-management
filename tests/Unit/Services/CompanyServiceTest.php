<?php

declare(strict_types=1);

use App\Models\Company;
use App\Services\CompanyService;
use App\Dtos\Company\CreateCompanyDto;
use App\Dtos\Company\UpdateCompanyDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('retrieves all companies', function () {
    Company::factory()->createOne();
    Company::factory()->createOne();

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $companies = $service->getAll();

    expect($companies)->toHaveCount(2);
    expect($companies)->toBeInstanceOf(Collection::class);
});

it('retrieves a company by id', function () {
    Company::factory()->create(['name' => 'Company A']);

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $company = $service->getById(1);

    expect($company)->not->toBeNull();
    expect($company->name)->toBe('Company A');
});

it('creates a company', function () {
    /** @var Company */
    $company = Company::factory()->createOne();

    $dto = new CreateCompanyDto(
        name: $company->name,
        email: $company->email . 'dummy',
        tax_number: $company->tax_number . '000',
        phone: $company->phone,
        address: $company->address
    );

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $company = $service->create($dto);

    expect($company)->not->toBeNull();
});

it('updates a company', function () {
    /** @var Company */
    $company = Company::factory()->createOne();

    $dto = new UpdateCompanyDto(
        name: $company->name . ' updated name',
        email: $company->email,
        tax_number: $company->tax_number . '999',
        phone: $company->phone,
        address: $company->address
    );

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $companyUpdated = $service->update(1, $dto);

    expect($company)->not->toBeNull();
    expect($companyUpdated->name)->toBe($company->name . ' updated name');
});

it('deletes a company', function () {
    /** @var Company */
    Company::factory()->createOne();

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $isDeleted = $service->delete(1);

    expect($isDeleted)->toBeTrue();
});
