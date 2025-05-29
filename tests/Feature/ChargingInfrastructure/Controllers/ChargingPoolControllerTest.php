<?php

declare(strict_types=1);

use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;

uses(DatabaseMigrations::class);

it('can get all chargingPools', function () {
    ChargingPool::factory()->count(2)->create();

    /** @var TestResponse $response $response */
    $response = $this->get('/api/charging-pools');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'name',
                'address',
                'country',
                'state',
                'city',
                'postal_code',
                'latitude',
                'longitude',
                'type',
                'description',
                'company_id',
            ],
        ],
    ]);
});

it('can get a single chargingPool', function () {
    ChargingPool::factory()->count(2)->create();

    /** @var TestResponse $response $response */
    $response = $this->get('/api/charging-pools/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'address',
            'country',
            'state',
            'city',
            'postal_code',
            'latitude',
            'longitude',
            'type',
            'description',
            'company_id',
        ],
    ]);
});

it('cannot get a single chargingPool', function () {
    ChargingPool::factory()->createOne();

    /** @var TestResponse $response $response */
    $response = $this->get('/api/charging-pools/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a chargingPool', function () {
    /** @var TestResponse $response */
    $response = $this->postJson('/api/charging-pools', [
        'name' => 'Random Charging Pool',
        'address' => 'St. Random Address',
        'country' => 'Random',
        'state' => 'Random State',
        'city' => 'Random City',
        'postal_code' => '4712-xxx',
        'latitude' => '',
        'longitude' => '',
        'type' => 'public',
        'description' => 'this is a public charging pool',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'address',
            'country',
            'state',
            'city',
            'postal_code',
            'latitude',
            'longitude',
            'type',
            'description',
            'company_id',
        ],
    ]);
});

it('cannot create a chargingPool without email', function () {
    /** @var TestResponse $response */
    $response = $this->postJson('/api/charging-pools', [
        'name' => 'Test ChargingPool',
        'email' => '',
        'phone' => '123456789',
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure([
        'status',
        'message',
        'errors',
    ]);
});

it('can delete a chargingPool', function () {
    ChargingPool::factory()->count(2)->create();

    /** @var TestResponse $response */
    $response = $this->deleteJson('/api/charging-pools/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a chargingPool with id that does not exist', function () {
    ChargingPool::factory()->count(1)->create();

    /** @var TestResponse $response */
    $response = $this->deleteJson('/api/charging-pools/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a chargingPool', function () {
    ChargingPool::factory()->createOne();

    /** @var TestResponse $response */
    $response = $this->putJson('/api/charging-pools/1', [
        'name' => 'Updated ChargingPool',
        'email' => 'exampleupdated@example.com',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a chargingPool', function () {
    ChargingPool::factory()->createOne();

    /** @var TestResponse $response */
    $response = $this->putJson('/api/charging-pools/2', [
        'name' => 'Updated ChargingPool',
        'email' => 'a@example.com',
        'phone' => '99999999',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
