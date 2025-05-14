<?php

declare(strict_types=1);

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

test('it can retrieve a vehicle by id', function () {
    $vehicle = Vehicle::factory()->createOne();

    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $retrievedVehicle = $repository->getById($vehicle->id);

    expect($retrievedVehicle)
        ->not->toBeNull()
        ->and($retrievedVehicle->id)->toBe($vehicle->id);
});

test('it can create a new vehicle', function () {
    $data = [
        'make' => 'Best Make',
        'model' => 'Maker',
        'plate_number' => '98673892',
        'battery_capacity_kwh' => '100.23',
    ];

    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $createdVehicle = $repository->create($data);

    expect($createdVehicle)
        ->not->toBeNull()
        ->and($createdVehicle->make)->toBe($data['make'])
        ->and($createdVehicle->model)->toBe($data['model']);
});

test('it can update an existing vehicle', function () {
    $vehicle = Vehicle::factory()->createOne();

    $updateData = [
        'model' => 'Updated Vehicle Model',
    ];

    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $updatedVehicle = $repository->update($updateData, $vehicle);

    expect($updatedVehicle)
        ->not->toBeNull()
        ->and($updatedVehicle->model)->toBe($updateData['model']);
});

test('it cannot update a vehicle that does not exist', function () {
    Vehicle::factory()->createOne();

    $updateData = [
        'model' => 'Updated Vehicle Model',
    ];

    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $updatedVehicle = $repository->update($updateData, -1);

    expect($updatedVehicle)
        ->toBeNull();
});

test('it can delete a vehicle', function () {
    $vehicle = Vehicle::factory()->createOne();

    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $deleted = $repository->delete($vehicle->id);

    expect($deleted)->toBeTrue();
    expect(Vehicle::find($vehicle->id))->toBeNull();
});

test('it cannot delete a vehicle that does not exist', function () {
    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $deleted = $repository->delete(-1);

    expect($deleted)->toBeFalse();
});

test('it can retrieve all vehicles', function () {
    $vehicles = Vehicle::factory()->count(5)->create();

    /** @var VehicleRepository */
    $repository = app(VehicleRepository::class);
    $retrievedCompanies = $repository->getAll();

    expect($retrievedCompanies)
        ->toHaveCount($vehicles->count())
        ->and($retrievedCompanies->pluck('id')->sort()->values())
        ->toEqual($vehicles->pluck('id')->sort()->values());
});
