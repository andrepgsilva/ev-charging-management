<?php

declare(strict_types=1);

use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

uses(DatabaseMigrations::class);

it('can get all chargingPoints', function () {
    ChargingPoint::factory()->count(2)->create();

    /** @var TestResponse $response $response */
    $response = $this->get('/api/charging-points');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'label',
                'vendor',
                'serial_number',
                'description',
                'charging_pool_id',
            ],
        ],
    ]);
});

it('can get a single chargingPoint', function () {
    ChargingPoint::factory()->count(2)->create();

    /** @var TestResponse $response $response */
    $response = $this->get('/api/charging-points/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'label',
            'vendor',
            'serial_number',
            'description',
            'charging_pool_id',
        ],
    ]);
});

it('cannot get a single chargingPoint', function () {
    ChargingPoint::factory()->createOne();

    /** @var TestResponse $response $response */
    $response = $this->get('/api/charging-points/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a chargingPoint', function () {
    /** @var TestResponse $response */
    $response = $this->postJson('/api/charging-points', [
        'label' => 'Random Label',
        'vendor' => 'Random Vendor',
        'serial_number' => 'Random Serial Number',
        'description' => 'Random Description',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'label',
            'vendor',
            'serial_number',
            'description',
            'charging_pool_id',
        ],
    ]);
});

it('cannot create a chargingPoint without email', function () {
    /** @var TestResponse $response */
    $response = $this->postJson('/api/charging-points', [
        'label' => '',
        'vendor' => 'Random Vendor',
        'serial_number' => 'Random Serial Number',
        'description' => 'Random Description',
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure([
        'status',
        'message',
        'errors',
    ]);
});

it('can delete a chargingPoint', function () {
    ChargingPoint::factory()->count(2)->create();

    /** @var TestResponse $response */
    $response = $this->deleteJson('/api/charging-points/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a chargingPoint with id that does not exist', function () {
    ChargingPoint::factory()->count(1)->create();

    /** @var TestResponse $response */
    $response = $this->deleteJson('/api/charging-points/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a chargingPoint', function () {
    ChargingPoint::factory()->createOne();

    /** @var TestResponse $response */
    $response = $this->putJson('/api/charging-points/1', [
        'vendor' => 'Random Vendor',
        'serial_number' => 'Random Serial Number',
        'description' => 'Random Description',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a chargingPoint', function () {
    ChargingPoint::factory()->createOne();

    /** @var TestResponse $response */
    $response = $this->putJson('/api/charging-points/2', [
        'vendor' => 'Random Vendor 2',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
