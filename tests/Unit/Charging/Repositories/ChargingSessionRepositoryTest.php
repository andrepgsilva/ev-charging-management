<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;
use App\Modules\Charging\Repositories\ChargingSessionRepository;

uses(DatabaseMigrations::class);

it('it can retrieve a chargingSession by id', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $retrievedChargingSession = $repository->getById($chargingSession->id);

    expect($retrievedChargingSession)
        ->not->toBeNull()
        ->and($retrievedChargingSession->id)->toBe($chargingSession->id);
});

it('it can create a new chargingSession', function () {
    ChargingPoint::factory()->createOne();
    Vehicle::factory()->createOne();
    Driver::factory()->createOne();

    $data = [
        'charging_point_id' => 1,
        'vehicle_id' => 1,
        'driver_id' => 1,
        'start_time' => now()->toDateTimeString(),
        'end_time' => now()->addHour()->toDateTimeString(),
        'energy_kwh' => '321.45',
        'cost' => '492.85',
        'connector_number' => 1,
    ];

    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $createdChargingSession = $repository->create($data);

    expect($createdChargingSession)
        ->not->toBeNull()
        ->and($createdChargingSession->cost)->toBe($data['cost'])
        ->and($createdChargingSession->connector_number)->toBe($data['connector_number']);
});

it('it can update an existing chargingSession', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    $updateData = [
        'connector_number' => 3,
    ];

    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $updatedChargingSession = $repository->update($chargingSession->id, $updateData);

    expect($updatedChargingSession)
        ->not->toBeNull()
        ->and($updatedChargingSession->connector_number)
        ->toBe($updateData['connector_number']);
});

it('it cannot update a chargingSession that does not exist', function () {
    ChargingSession::factory()->createOne();

    $updateData = [
        'connector_number' => 2,
    ];

    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $updatedChargingSession = $repository->update(-1, $updateData);

    expect($updatedChargingSession)
        ->toBeNull();
});

it('it can delete a chargingSession', function () {
    $chargingSession = ChargingSession::factory()->createOne();

    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $deleted = $repository->delete($chargingSession->id);

    expect($deleted)->toBeTrue();
    expect(ChargingSession::find($chargingSession->id))->toBeNull();
});

it('it cannot delete a chargingSession that does not exist', function () {
    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $deleted = $repository->delete(-1);

    expect($deleted)->toBeFalse();
});

it('it can retrieve all chargingSessions', function () {
    $chargingSessions = ChargingSession::factory()->count(5)->create();

    /** @var ChargingSessionRepository $repository */
    $repository = app(ChargingSessionRepository::class);
    $retrievedCompanies = $repository->getAll();

    expect($retrievedCompanies)
        ->toHaveCount($chargingSessions->count())
        ->and($retrievedCompanies->pluck('id')->sort()->values())
        ->toEqual($chargingSessions->pluck('id')->sort()->values());
});
