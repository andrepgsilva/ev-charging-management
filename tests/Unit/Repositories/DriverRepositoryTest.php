<?php

declare(strict_types=1);

use App\Models\Driver;
use App\Repositories\DriverRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

test('it can retrieve a driver by id', function () {
    $driver = Driver::factory()->createOne();

    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $retrievedDriver = $repository->getById($driver->id);

    expect($retrievedDriver)
        ->not->toBeNull()
        ->and($retrievedDriver->id)->toBe($driver->id);
});

test('it can create a new driver', function () {
    $data = [
        'name' => 'Test Driver',
        'email' => 'test@example.com',
        'phone' => '1234567890',
    ];

    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $createdDriver = $repository->create($data);

    expect($createdDriver)
        ->not->toBeNull()
        ->and($createdDriver->name)->toBe($data['name'])
        ->and($createdDriver->email)->toBe($data['email']);
});

test('it can update an existing driver', function () {
    $driver = Driver::factory()->createOne();

    $updateData = [
        'name' => 'Updated Driver Name',
    ];

    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $updatedDriver = $repository->update($driver->id, $updateData);

    expect($updatedDriver)
        ->not->toBeNull()
        ->and($updatedDriver->name)->toBe($updateData['name']);
});

test('it cannot update a driver that does not exist', function () {
    Driver::factory()->createOne();

    $updateData = [
        'name' => 'Updated Driver Name',
    ];

    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $updatedDriver = $repository->update(-1, $updateData);

    expect($updatedDriver)
        ->toBeNull();
});

test('it can delete a driver', function () {
    $driver = Driver::factory()->createOne();

    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $deleted = $repository->delete($driver->id);

    expect($deleted)->toBeTrue();
    expect(Driver::find($driver->id))->toBeNull();
});

test('it cannot delete a driver that does not exist', function () {
    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $deleted = $repository->delete(-1);

    expect($deleted)->toBeFalse();
});

test('it can retrieve all drivers', function () {
    $drivers = Driver::factory()->count(5)->create();

    /** @var DriverRepository */
    $repository = app(DriverRepository::class);
    $retrievedCompanies = $repository->getAll();

    expect($retrievedCompanies)
        ->toHaveCount($drivers->count())
        ->and($retrievedCompanies->pluck('id')->sort()->values())
        ->toEqual($drivers->pluck('id')->sort()->values());
});
