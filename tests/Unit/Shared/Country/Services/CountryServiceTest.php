<?php

declare(strict_types=1);

use App\Shared\Country\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use App\Shared\Country\Services\CountryService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('retrieves all countries', function () {
    Country::factory()->createOne();
    Country::factory()->createOne();

    /** @var CountryService $service */
    $service = app(CountryService::class);

    $countries = $service->getAll();

    expect($countries)->toHaveCount(2);
    expect($countries)->toBeInstanceOf(Collection::class);
});

/* it('retrieves a driver by id', function () { */
/*     Driver::factory()->create(['name' => 'Driver A']); */
/**/
/*     /** @var DriverService $service */
/*     $service = app(DriverService::class); */
/**/
/*     $driver = $service->getById(1); */
/**/
/*     expect($driver)->not->toBeNull(); */
/*     expect($driver->name)->toBe('Driver A'); */
/* }); */
/**/
/* it('creates a driver', function () { */
/*     /** @var Driver $driver */
/*     $driver = Driver::factory()->makeOne(); */
/**/
/*     unset($driver->id); */
/*     unset($driver->created_at); */
/*     unset($driver->updated_at); */
/**/
/*     $dto = new CreateDriverDto(); */
/*     /** */
/*      * @var array{ */
/*      *  name: string, */
/*      *  email: string, */
/*      *  tax_number: string, */
/*      *  phone?: string, */
/*      *  address?: string, */
/*      * } $data */
/* */
/*     $data = $driver->toArray(); */
/*     $dto->fill($data); */
/**/
/*     /** @var DriverService $service */
/*     $service = app(DriverService::class); */
/**/
/*     $driver = $service->create($dto); */
/**/
/*     expect($driver)->not->toBeNull(); */
/* }); */
/**/
/* it('updates a driver', function () { */
/*     /** @var Driver $driver */
/*     $driver = Driver::factory()->createOne(); */
/**/
/*     $dto = new UpdateDriverDto(); */
/**/
/*     $dto->name = $driver->name . ' updated name'; */
/*     $dto->email = $driver->email; */
/*     $dto->phone = $driver->phone; */
/**/
/*     /** @var DriverService $service */
/*     $service = app(DriverService::class); */
/**/
/*     $driverUpdated = $service->update(1, $dto); */
/**/
/*     expect($driver)->not->toBeNull(); */
/*     expect($driverUpdated->name)->toBe($driver->name . ' updated name'); */
/* }); */
/**/
/* it('deletes a driver', function () { */
/*     /** @var Driver */
/*     Driver::factory()->createOne(); */
/**/
/*     /** @var DriverService */
/*     $service = app(DriverService::class); */
/**/
/*     $isDeleted = $service->delete(1); */
/**/
/*     expect($isDeleted)->toBeTrue(); */
/* }); */
