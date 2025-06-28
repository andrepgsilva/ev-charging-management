<?php

declare(strict_types=1);

use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\Company\Dtos\CreateCompanyDto;
use App\Modules\Company\Dtos\UpdateCompanyDto;
use App\Modules\Company\Services\CompanyService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

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
    $company = Company::factory()->makeOne();

    unset($company->id);
    unset($company->created_at);
    unset($company->updated_at);

    $dto = new CreateCompanyDto();
    $dto->fill($company->toArray());

    $dto->taxNumber = '678678788';
    $dto->email = 'pest@example.com';

    /** @var CompanyService $service */
    $service = app(CompanyService::class);

    $company = $service->create($dto);

    expect($company)->not->toBeNull();
});

it('updates a company', function () {
    /** @var Company */
    $company = Company::factory()->createOne();

    $dto = new UpdateCompanyDto();

    $dto->name = $company->name.' updated name';
    $dto->email = $company->email;
    $dto->taxNumber = $company->tax_number.'999';
    $dto->phone = $company->phone;
    $dto->address = $company->address;

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $companyUpdated = $service->update(1, $dto);

    expect($company)->not->toBeNull();
    expect($companyUpdated->name)->toBe($company->name.' updated name');
});

it('deletes a company', function () {
    /** @var Company */
    Company::factory()->createOne();

    /** @var CompanyService */
    $service = app(CompanyService::class);

    $isDeleted = $service->delete(1);

    expect($isDeleted)->toBeTrue();
});
