<?php

declare(strict_types=1);

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it can retrieve a company by id', function () {
    $company = Company::factory()->createOne();

    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $retrievedCompany = $repository->getById($company->id);

    expect($retrievedCompany)
        ->not->toBeNull()
        ->and($retrievedCompany->id)->toBe($company->id);
});

test('it can create a new company', function () {
    $data = [
        'name' => 'Test Company',
        'email' => 'test@example.com',
        'tax_number' => '123456789',
        'phone' => '1234567890',
        'address' => '123 Test Street',
    ];

    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $createdCompany = $repository->create($data);

    expect($createdCompany)
        ->not->toBeNull()
        ->and($createdCompany->name)->toBe($data['name'])
        ->and($createdCompany->email)->toBe($data['email']);
});

test('it can update an existing company', function () {
    $company = Company::factory()->createOne();

    $updateData = [
        'name' => 'Updated Company Name',
    ];

    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $updatedCompany = $repository->update($company->id, $updateData);

    expect($updatedCompany)
        ->not->toBeNull()
        ->and($updatedCompany->name)->toBe($updateData['name']);
});

test('it cannot update a company that does not exist', function () {
    Company::factory()->createOne();

    $updateData = [
        'name' => 'Updated Company Name',
    ];

    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $updatedCompany = $repository->update(-1, $updateData);

    expect($updatedCompany)
        ->toBeNull();
});

test('it can delete a company', function () {
    $company = Company::factory()->createOne();

    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $deleted = $repository->delete($company->id);

    expect($deleted)->toBeTrue();
    expect(Company::find($company->id))->toBeNull();
});

test('it cannot delete a company that does not exist', function () {
    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $deleted = $repository->delete(-1);

    expect($deleted)->toBeFalse();
});

test('it can retrieve all companies', function () {
    $companies = Company::factory()->count(5)->create();

    /** @var CompanyRepository */
    $repository = app(CompanyRepository::class);
    $retrievedCompanies = $repository->getAll();

    expect($retrievedCompanies)
        ->toHaveCount($companies->count())
        ->and($retrievedCompanies->pluck('id')->sort()->values())
        ->toEqual($companies->pluck('id')->sort()->values());
});
