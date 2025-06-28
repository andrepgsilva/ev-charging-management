<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Repositories;

use App\Shared\Authentication\Models\User;
use Illuminate\Database\Eloquent\Collection;

final readonly class UserRepository
{
    public function __construct(
        private User $model
    ) {
        //
    }

    /**
     * @return Collection<int, User>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?User
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): User
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(User|int $user, array $data): ?User
    {
        if (! ($user instanceof User)) {
            $user = $this->getById($user);
        }

        if (! is_null($user)) {
            $user->fill($data);
            $user->save();

            return $user;
        }

        return null;
    }

    public function delete(User|int $user): bool
    {
        if (! ($user instanceof User)) {
            $user = $this->getById($user);
        }

        if (! is_null($user)) {
            return (bool) $user->delete();
        }

        return false;
    }
}
