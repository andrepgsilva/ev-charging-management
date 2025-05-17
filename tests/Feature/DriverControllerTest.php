<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\TestResponse;

uses(DatabaseMigrations::class);

it('can get all drivers', function () {
    Driver::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->get('/api/drivers');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'name',
                'email',
                'phone',
                'company_id',
            ],
        ],
    ]);
});

it('can get a single driver', function () {
    Driver::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->get('/api/drivers/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'email',
            'phone',
            'company_id',
        ],
    ]);
});

it('cannot get a single driver', function () {
    Driver::factory()->createOne();

    /** @var TestResponse */
    $response = $this->get('/api/drivers/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a driver', function () {
    /** @var TestResponse */
    $response = $this->postJson('/api/drivers', [
        'name' => 'Test Driver',
        'email' => 'example@example.com',
        'phone' => '123456789',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'email',
            'phone',
            'company_id',
        ],
    ]);
});

it('cannot create a driver without email', function () {
    /** @var TestResponse */
    $response = $this->postJson('/api/drivers', [
        'name' => 'Test Driver',
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

it('can delete a driver', function () {
    Driver::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->deleteJson('/api/drivers/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a driver with id that does not exist', function () {
    Driver::factory()->count(1)->create();

    /** @var TestResponse */
    $response = $this->deleteJson('/api/drivers/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a driver', function () {
    Driver::factory()->createOne();

    /** @var TestResponse */
    $response = $this->putJson('/api/drivers/1', [
        'name' => 'Updated Driver',
        'email' => 'exampleupdated@example.com',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a driver', function () {
    Driver::factory()->createOne();

    /** @var TestResponse */
    $response = $this->putJson('/api/drivers/2', [
        'name' => 'Updated Driver',
        'email' => 'a@example.com',
        'phone' => '99999999',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
