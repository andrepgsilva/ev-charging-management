<?php

declare(strict_types=1);

use Illuminate\Testing\TestResponse;
use App\Modules\Fleet\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('can get all vehicles', function () {
    Vehicle::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->get('/api/vehicles');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'make',
                'model',
                'plate_number',
                'company_id',
                'driver_id',
            ],
        ],
    ]);
});

it('can get a single vehicle', function () {
    Vehicle::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->get('/api/vehicles/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'make',
            'model',
            'plate_number',
            'company_id',
            'driver_id',
        ],
    ]);
});

it('cannot get a single vehicle', function () {
    Vehicle::factory()->createOne();

    /** @var TestResponse */
    $response = $this->get('/api/vehicles/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a vehicle', function () {
    /** @var TestResponse */
    $response = $this->postJson('/api/vehicles', [
        'make' => 'Best Maker',
        'model' => 'make xyz',
        'plate_number' => '123456789',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'make',
            'model',
            'plate_number',
            'company_id',
            'driver_id',
        ],
    ]);
});

it('cannot create a vehicle without plate number', function () {
    /** @var TestResponse */
    $response = $this->postJson('/api/vehicles', [
        'make' => 'Test Maker',
        'model' => 'Test Model',
        'plate_number' => '',
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure([
        'status',
        'message',
        'errors',
    ]);
});

it('can delete a vehicle', function () {
    Vehicle::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->deleteJson('/api/vehicles/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a vehicle with id that does not exist', function () {
    Vehicle::factory()->count(1)->create();

    /** @var TestResponse */
    $response = $this->deleteJson('/api/vehicles/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a vehicle', function () {
    Vehicle::factory()->createOne();

    /** @var TestResponse */
    $response = $this->putJson('/api/vehicles/1', [
        'make' => 'Updated Vehicle Maker',
        'model' => 'Model Updated',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a vehicle', function () {
    Vehicle::factory()->createOne();

    /** @var TestResponse */
    $response = $this->putJson('/api/vehicles/2', [
        'make' => 'Updated Vehicle Maker',
        'model' => 'Model Updated',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
