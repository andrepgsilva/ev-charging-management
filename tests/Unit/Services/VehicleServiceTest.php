<?php

declare(strict_types=1);

use App\Models\Vehicle;
use App\Services\VehicleService;
use App\Dtos\Vehicle\CreateVehicleDto;
use App\Dtos\Vehicle\UpdateVehicleDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('retrieves all vehicles', function () {
    Vehicle::factory()->createOne();
    Vehicle::factory()->createOne();

    /** @var VehicleService */
    $service = app(VehicleService::class);

    $vehicles = $service->getAll();

    expect($vehicles)->toHaveCount(2);
    expect($vehicles)->toBeInstanceOf(Collection::class);
});

it('retrieves a vehicle by id', function () {
    Vehicle::factory()->create(['model' => 'Vehicle A']);

    /** @var VehicleService */
    $service = app(VehicleService::class);

    $vehicle = $service->getById(1);

    expect($vehicle)->not->toBeNull();
    expect($vehicle->model)->toBe('Vehicle A');
});

it('creates a vehicle', function () {
    /** @var Vehicle */
    $vehicle = Vehicle::factory()->makeOne();

    unset($vehicle->id);
    unset($vehicle->created_at);
    unset($vehicle->updated_at);

    $dto = new CreateVehicleDto();
    $dto->fillFromArray($vehicle->toArray());

    /** @var VehicleService */
    $service = app(VehicleService::class);

    $vehicle = $service->create($dto);

    expect($vehicle)->not->toBeNull();
});

it('updates a vehicle', function () {
    /** @var Vehicle */
    $vehicle = Vehicle::factory()->createOne();

    $dto = new UpdateVehicleDto();

    $dto->model = $vehicle->model.' Best Maker';
    $dto->plateNumber = $vehicle->plateNumber.' 999999999';

    /** @var VehicleService */
    $service = app(VehicleService::class);

    $vehicleUpdated = $service->update($dto, $vehicle);

    expect($vehicle)->not->toBeNull();
    expect($vehicleUpdated->model)->toBe($vehicle->model);
});

it('deletes a vehicle', function () {
    /** @var Vehicle */
    Vehicle::factory()->createOne();

    /** @var VehicleService */
    $service = app(VehicleService::class);

    $isDeleted = $service->delete(1);

    expect($isDeleted)->toBeTrue();
});
