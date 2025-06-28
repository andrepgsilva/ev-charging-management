<?php

declare(strict_types=1);

use App\Shared\Authentication\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

test('to array', function () {
    $user = User::factory()->createOne();

    expect(array_keys($user->toArray()))
        ->toEqual([
            'name',
            'email',
            'email_verified_at',
            'updated_at',
            'created_at',
            'id',
        ]);
});
