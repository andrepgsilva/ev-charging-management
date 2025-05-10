<?php

declare(strict_types=1);

use App\Models\Driver;
use App\Services\DriverService;
use App\Dtos\Driver\CreateDriverDto;
use App\Dtos\Driver\UpdateDriverDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('retrieves all drivers', function () {
    Driver::factory()->createOne();
    Driver::factory()->createOne();

    /** @var DriverService */
    $service = app(DriverService::class);

    $drivers = $service->getAll();

    expect($drivers)->toHaveCount(2);
    expect($drivers)->toBeInstanceOf(Collection::class);
});

it('retrieves a driver by id', function () {
    Driver::factory()->create(['name' => 'Driver A']);

    /** @var DriverService */
    $service = app(DriverService::class);

    $driver = $service->getById(1);

    expect($driver)->not->toBeNull();
    expect($driver->name)->toBe('Driver A');
});

it('creates a driver', function () {
    /** @var Driver */
    $driver = Driver::factory()->makeOne();

    unset($driver->id);
    unset($driver->created_at);
    unset($driver->updated_at);
    $driver->email = 'pest@example.com';

    $dto = new CreateDriverDto();
    $dto->fillFromArray($driver->toArray());

    /** @var DriverService */
    $service = app(DriverService::class);

    $driver = $service->create($dto);

    expect($driver)->not->toBeNull();
});

it('updates a driver', function () {
    /** @var Driver */
    $driver = Driver::factory()->createOne();

    $dto = new UpdateDriverDto();

    $dto->name = $driver->name.' updated name';
    $dto->email = $driver->email;
    $dto->phone = $driver->phone;

    /** @var DriverService */
    $service = app(DriverService::class);

    $driverUpdated = $service->update(1, $dto);

    expect($driver)->not->toBeNull();
    expect($driverUpdated->name)->toBe($driver->name.' updated name');
});

it('deletes a driver', function () {
    /** @var Driver */
    Driver::factory()->createOne();

    /** @var DriverService */
    $service = app(DriverService::class);

    $isDeleted = $service->delete(1);

    expect($isDeleted)->toBeTrue();
});
