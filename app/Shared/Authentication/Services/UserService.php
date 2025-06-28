<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Shared\Authentication\Models\User;
use App\Shared\Authentication\Dtos\User\CreateUserDto;
use App\Shared\Authentication\Dtos\User\UpdateUserDto;
use App\Shared\Authentication\Repositories\UserRepository;

final readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
        //
    }

    /**
     * @return Collection<int, User>
     */
    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getById(int $id): ?User
    {
        return $this->userRepository->getById($id);
    }

    public function create(CreateUserDto $createUserDto): User
    {
        $createUserDto->remember_token = Str::random(10);
        $createUserDto->password = Hash::make($createUserDto->password);
        $user = $this->userRepository->create($createUserDto->toArray());
        $user->createToken('auth_token')->plainTextToken;

        return $user;
    }

    public function update(User|int $user, UpdateUserDto $updateUserDto): ?User
    {
        return $this->userRepository->update($user, $updateUserDto->toArray());
    }

    public function delete(User|int $user): bool
    {
        return $this->userRepository->delete($user);
    }
}
