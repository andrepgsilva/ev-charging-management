<?php

declare(strict_types=1);

use App\Shared\Authentication\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Shared\Authentication\Repositories\UserRepository;

uses(DatabaseMigrations::class);

it('can retrieve a user by id', function () {
    $user = User::factory()->createOne();

    /** @var UserRepository */
    $repository = app(UserRepository::class);
    $retrievedUser = $repository->getById($user->id);

    expect($retrievedUser)
        ->not->toBeNull()
        ->and($retrievedUser->id)->toBe($user->id);
});

it('can create a new user', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'x1sP0wdfK',
    ];

    /** @var UserRepository */
    $repository = app(UserRepository::class);
    $createdUser = $repository->create($data);

    expect($createdUser)
        ->not->toBeNull()
        ->and($createdUser->name)->toBe($data['name'])
        ->and($createdUser->email)->toBe($data['email']);
});

it('can update an existing user', function () {
    $user = User::factory()->createOne();

    $updateData = [
        'name' => 'Updated User Name',
    ];

    /** @var UserRepository $repository */
    $repository = app(UserRepository::class);
    $updatedUser = $repository->update($user->id, $updateData);

    expect($updatedUser)
        ->not->toBeNull()
        ->and($updatedUser->name)->toBe($updateData['name']);
});

it('cannot update a user that does not exist', function () {
    User::factory()->createOne();

    $updateData = [
        'name' => 'Updated User Name',
    ];

    /** @var UserRepository */
    $repository = app(UserRepository::class);
    $updatedUser = $repository->update(-1, $updateData);

    expect($updatedUser)
        ->toBeNull();
});

it('can delete a user', function () {
    $user = User::factory()->createOne();

    /** @var UserRepository */
    $repository = app(UserRepository::class);
    $deleted = $repository->delete($user->id);

    expect($deleted)->toBeTrue();
    expect(User::find($user->id))->toBeNull();
});

it('cannot delete a user that does not exist', function () {
    /** @var UserRepository */
    $repository = app(UserRepository::class);
    $deleted = $repository->delete(-1);

    expect($deleted)->toBeFalse();
});

it('can retrieve all users', function () {
    $users = User::factory()->count(5)->create();

    /** @var UserRepository */
    $repository = app(UserRepository::class);
    $retrievedCompanies = $repository->getAll();

    expect($retrievedCompanies)
        ->toHaveCount($users->count())
        ->and($retrievedCompanies->pluck('id')->sort()->values())
        ->toEqual($users->pluck('id')->sort()->values());
});
