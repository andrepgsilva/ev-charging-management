<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\ChargingInfrastructure\Services\ChargingPoolService;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPool\CreateChargingPoolDto;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPool\UpdateChargingPoolDto;

uses(DatabaseMigrations::class);

it('retrieves all chargingPools', function () {
    ChargingPool::factory()->createOne();
    ChargingPool::factory()->createOne();

    /** @var ChargingPoolService $service */
    $service = app(ChargingPoolService::class);

    $chargingPools = $service->getAll();

    expect($chargingPools)->toHaveCount(2);
    expect($chargingPools)->toBeInstanceOf(Collection::class);
});

it('retrieves a chargingPool by id', function () {
    ChargingPool::factory()->create(['name' => 'ChargingPool A']);

    /** @var ChargingPoolService $service */
    $service = app(ChargingPoolService::class);

    $chargingPool = $service->getById(1);

    expect($chargingPool)->not->toBeNull();
    expect($chargingPool->name)->toBe('ChargingPool A');
});

it('creates a chargingPool', function () {
    /** @var ChargingPool $chargingPool */
    $chargingPool = ChargingPool::factory()->makeOne();

    unset($chargingPool->id);
    unset($chargingPool->created_at);
    unset($chargingPool->updated_at);

    $dto = new CreateChargingPoolDto();
    /**
     * @var array{
     *  name?: string,
     *  address?: string,
     *  country?: string,
     *  state?: string,
     *  city?: string,
     *  postal_code?: string,
     *  latitude?: string,
     *  longitude?: string,
     *  type?: string,
     *  description?: string,
     *  company_id?: string,
     * } $data
     */
    $data = $chargingPool->toArray();
    $dto->fill($data);

    /** @var ChargingPoolService $service */
    $service = app(ChargingPoolService::class);

    $chargingPool = $service->create($dto);

    expect($chargingPool)->not->toBeNull();
});

it('updates a chargingPool', function () {
    /** @var ChargingPool $chargingPool */
    $chargingPool = ChargingPool::factory()->createOne();

    $dto = new UpdateChargingPoolDto();

    $dto->name = $chargingPool->name.' updated name';

    /** @var ChargingPoolService $service */
    $service = app(ChargingPoolService::class);

    $chargingPoolUpdated = $service->update(1, $dto);

    expect($chargingPool)->not->toBeNull();
    expect($chargingPoolUpdated->name)->toBe($chargingPool->name.' updated name');
});

it('cannot update a chargingPool', function () {
    /** @var ChargingPool $chargingPool */
    $chargingPool = ChargingPool::factory()->createOne();

    $dto = new UpdateChargingPoolDto();

    $dto->name = $chargingPool->name.' updated name';

    /** @var ChargingPoolService $service */
    $service = app(ChargingPoolService::class);

    $chargingPoolUpdated = $service->update(99, $dto);

    expect($chargingPoolUpdated)->toBeNull();
})->only();

it('deletes a chargingPool', function () {
    /** @var ChargingPool */
    ChargingPool::factory()->createOne();

    /** @var ChargingPoolService */
    $service = app(ChargingPoolService::class);

    $isDeleted = $service->delete(1);

    expect($isDeleted)->toBeTrue();
});

it('cannot delete a chargingPool', function () {
    /** @var ChargingPool */
    ChargingPool::factory()->createOne();

    /** @var ChargingPoolService */
    $service = app(ChargingPoolService::class);

    $isDeleted = $service->delete(99);

    expect($isDeleted)->toBeFalse();
});
