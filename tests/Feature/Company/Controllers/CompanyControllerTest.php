<?php

declare(strict_types=1);

use App\Modules\Company\Models\Company;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('can get all companies', function () {
    Company::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->get('/api/companies');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'name',
                'email',
                'tax_number',
                'phone',
                'address',
            ],
        ],
    ]);
});

it('can get a single company', function () {
    Company::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->get('/api/companies/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'email',
            'tax_number',
            'phone',
            'address',
        ],
    ]);
});

it('cannot get a single company', function () {
    Company::factory()->createOne();

    /** @var TestResponse */
    $response = $this->get('/api/companies/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a company', function () {
    /** @var TestResponse */
    $response = $this->postJson('/api/companies', [
        'name' => 'Test Company',
        'email' => 'example@example.com',
        'tax_number' => '123456789',
        'phone' => '123456789',
        'address' => '123 Test St',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'email',
            'tax_number',
            'phone',
            'address',
        ],
    ]);
});

it('cannot create a company without email', function () {
    /** @var TestResponse */
    $response = $this->postJson('/api/companies', [
        'name' => 'Test Company',
        'email' => '',
        'tax_number' => '123456789',
        'phone' => '123456789',
        'address' => '123 Test St',
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure([
        'status',
        'message',
        'errors',
    ]);
});

it('can delete a company', function () {
    Company::factory()->count(2)->create();

    /** @var TestResponse */
    $response = $this->deleteJson('/api/companies/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a company with id that does not exist', function () {
    Company::factory()->count(1)->create();

    /** @var TestResponse */
    $response = $this->deleteJson('/api/companies/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a company', function () {
    Company::factory()->createOne();

    /** @var TestResponse */
    $response = $this->putJson('/api/companies/1', [
        'name' => 'Updated Company',
        'email' => 'exampleupdated@example.com',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a company', function () {
    Company::factory()->createOne();

    /** @var TestResponse */
    $response = $this->putJson('/api/companies/2', [
        'name' => 'Updated Company',
        'email' => 'a@example.com',
        'tax_number' => '986797899',
        'phone' => '99999999',
        'address' => '123 Test St',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
