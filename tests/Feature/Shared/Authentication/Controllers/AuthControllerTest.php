<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Hash;
use App\Shared\Authentication\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('can login', function () {
    $user = User::factory()->createOne([
        'password' => Hash::make('qe3123xrqO'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => 'qe3123xrqO',
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
        'data',
    ]);
});

it('cannot login', function () {
    $user = User::factory()->createOne([
        'password' => Hash::make('qe3123xrqO'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'email' => 'randomEmail@example.com',
        'password' => 'qe3123xrqO',
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});

it('can logout', function () {
    $user = User::factory()->createOne([
        'password' => Hash::make('qe3123xrqO'),
    ]);

    $loginResponse = $this->postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => 'qe3123xrqO',
    ]);

    $response = $this->getJson('/api/auth/logout', [
        'Authorization' => 'Bearer '.$loginResponse->json('data.token'),
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'message',
    ]);
});
