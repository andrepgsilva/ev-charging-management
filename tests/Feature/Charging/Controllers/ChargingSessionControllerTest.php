<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

uses(DatabaseMigrations::class);

it('can get all chargingSessions', function () {
    ChargingSession::factory()->count(2)->create();

    $response = $this->get('/api/charging-sessions');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'charging_point_id',
                'vehicle_id',
                'driver_id',
                'start_time',
                'end_time',
                'energy_kwh',
                'cost',
                'connector_number',
            ],
        ],
    ]);
});

it('can get a single chargingSession', function () {
    ChargingSession::factory()->count(2)->create();

    $response = $this->get('/api/charging-sessions/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'charging_point_id',
            'vehicle_id',
            'driver_id',
            'start_time',
            'end_time',
            'energy_kwh',
            'cost',
            'connector_number',
        ],
    ]);
});

it('cannot get a single chargingSession', function () {
    $response = $this->get('/api/charging-sessions/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a chargingSession', function () {
    ChargingPoint::factory()->createOne();
    Vehicle::factory()->createOne();
    Driver::factory()->createOne();

    $response = $this->postJson('/api/charging-sessions', [
        'charging_point_id' => 1,
        'vehicle_id' => 1,
        'driver_id' => 1,
        'start_time' => now()->toDateTimeString(),
        'end_time' => now()->addHour()->toDateTimeString(),
        'energy_kwh' => '321.45',
        'cost' => '492.85',
        'connector_number' => 1,
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'charging_point_id',
            'vehicle_id',
            'driver_id',
            'start_time',
            'end_time',
            'energy_kwh',
            'cost',
            'connector_number',
        ],
    ]);
});

it('cannot create a chargingSession without charging point id', function () {
    $response = $this->postJson('/api/charging-sessions', [
        'vehicle_id' => 1,
        'driver_id' => 1,
        'start_time' => now()->toDateTimeString(),
        'end_time' => now()->addHour()->toDateTimeString(),
        'energy_kwh' => '321.45',
        'cost' => '492.85',
        'connector_number' => 1,
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure([
        'status',
        'message',
        'errors',
    ]);
});

it('can delete a chargingSession', function () {
    ChargingSession::factory()->count(2)->create();

    $response = $this->deleteJson('/api/charging-sessions/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a chargingSession with id that does not exist', function () {
    ChargingSession::factory()->count(1)->create();

    $response = $this->deleteJson('/api/charging-sessions/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a chargingSession', function () {
    ChargingSession::factory()->createOne();

    $response = $this->putJson('/api/charging-sessions/1', [
        'connector_number' => 3,
        'cost' => '872.94',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a chargingSession', function () {
    ChargingSession::factory()->createOne();

    $response = $this->putJson('/api/charging-sessions/99', [
        'connector_number' => 3,
        'cost' => '872.94',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
