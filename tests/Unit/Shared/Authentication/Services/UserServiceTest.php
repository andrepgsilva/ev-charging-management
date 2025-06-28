<?php

declare(strict_types=1);

use App\Shared\Authentication\Models\User;
use App\Shared\Authentication\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('retrieves a user by id', function () {
    User::factory()->create();

    /** @var UserService $service */
    $service = app(UserService::class);

    $user = $service->getById(1);

    expect($user)->not->toBeNull();
});
