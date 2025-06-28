<?php

declare(strict_types=1);

use App\Shared\Authentication\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('can get all users', function () {
    User::factory()->count(2)->create();

    $response = $this->get('/api/users');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            '*' => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'token',
            ],
        ],
    ]);
});

it('can get a single user', function () {
    User::factory()->count(2)->create();

    $response = $this->get('/api/users/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'email',
            'email_verified_at',
            'token',
        ],
    ]);
});

it('cannot get a single user', function () {
    $response = $this->get('/api/users/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can create a user', function () {
    $response = $this->postJson('/api/users', [
        'name' => 'User',
        'email' => 'email@example.com',
        'password' => 'qe3123xrqO',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'id',
            'name',
            'email',
            'email_verified_at',
            'token',
        ],
    ]);
});

it('can delete a user', function () {
    User::factory()->count(2)->create();

    $response = $this->deleteJson('/api/users/2');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('cannot delete a user with id that does not exist', function () {
    User::factory()->count(1)->create();

    $response = $this->deleteJson('/api/users/2');

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can update a user', function () {
    User::factory()->createOne();

    $response = $this->putJson('/api/users/1', [
        'name' => 'xyz',
        'email' => 'xyz@example.com',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot update a user', function () {
    User::factory()->createOne();

    $response = $this->putJson('/api/users/99', [
        'name' => 'xyz',
        'email' => 'xyz@example.com',
    ]);

    $response->assertStatus(404);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
