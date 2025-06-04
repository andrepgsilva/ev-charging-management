<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;
use App\Modules\ChargingInfrastructure\Services\ChargingPointService;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPoint\CreateChargingPointDto;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPoint\UpdateChargingPointDto;

uses(DatabaseMigrations::class);

it('retrieves all chargingPoints', function () {
    ChargingPoint::factory()->createOne();
    ChargingPoint::factory()->createOne();

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    $chargingPoints = $service->getAll();

    expect($chargingPoints)->toHaveCount(2)
        ->and($chargingPoints)->toBeInstanceOf(Collection::class);
});

it('retrieves a chargingPoint by id', function () {
    ChargingPoint::factory()->create(['label' => 'ChargingPoint A']);

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    /** @var ChargingPoint $chargingPoint */
    $chargingPoint = $service->getById(1);

    expect($chargingPoint)->not->toBeNull()
        ->and($chargingPoint->label)->toBe('ChargingPoint A');
});

it('creates a chargingPoint', function () {
    /** @var ChargingPoint $chargingPoint */
    $chargingPoint = ChargingPoint::factory()->makeOne();

    unset($chargingPoint->id);
    unset($chargingPoint->created_at);
    unset($chargingPoint->updated_at);

    $dto = new CreateChargingPointDto();
    /**
     * @var array{
     * label?: string,
     * vendor?: string,
     * serial_number?: string,
     * description?: string,
     * charging_pool_id?: int
     * } $data
     */
    $data = $chargingPoint->toArray();
    $dto->fillFromArray($data);

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    $chargingPoint = $service->create($dto);

    expect($chargingPoint)->not->toBeNull();
});

it('updates a chargingPoint', function () {
    /** @var ChargingPoint $chargingPoint */
    $chargingPoint = ChargingPoint::factory()->createOne();

    $dto = new UpdateChargingPointDto();

    $dto->label = $chargingPoint->label.' updated label';

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    /** @var ChargingPoint $chargingPointUpdated */
    $chargingPointUpdated = $service->update(1, $dto);

    expect($chargingPoint)->not->toBeNull()
        ->and($chargingPointUpdated->label)
        ->toBe($chargingPoint->label.' updated label');
});

it('cannot update a chargingPoint', function () {
    /** @var ChargingPoint $chargingPoint */
    $chargingPoint = ChargingPoint::factory()->createOne();

    $dto = new UpdateChargingPointDto();

    $dto->label = $chargingPoint->label.' updated label';

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    $chargingPointUpdated = $service->update(99, $dto);

    expect($chargingPointUpdated)->toBeNull();
})->only();

it('deletes a chargingPoint', function () {
    ChargingPoint::factory()->createOne();

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    $isDeleted = $service->delete(1);

    expect($isDeleted)->toBeTrue();
});

it('cannot delete a chargingPoint', function () {
    ChargingPoint::factory()->createOne();

    /** @var ChargingPointService $service */
    $service = app(ChargingPointService::class);

    $isDeleted = $service->delete(99);

    expect($isDeleted)->toBeFalse();
});
