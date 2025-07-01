<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Services;

use Illuminate\Support\Facades\Hash;
use App\Shared\Authentication\Models\User;
use Illuminate\Validation\ValidationException;
use App\Shared\Authentication\Dtos\Auth\UserLoginDto;
use App\Shared\Authentication\Repositories\UserRepository;

final readonly class AuthService
{
    public function __construct(
        public UserRepository $userRepository
    ) {
        //
    }

    /**
     * @return array{
     *     id: int,
     *     name: string,
     *     email: string,
     *     email_verified_at?: string,
     *     password: string,
     *     token: string
     * }
     *
     * @throws ValidationException
     */
    public function login(UserLoginDto $userLoginDto): array
    {
        $user = $this->userRepository->getByEmail($userLoginDto->email);

        if (is_null($user) || ! Hash::check($userLoginDto->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        /**
         * @var array{
         *      id: int,
         *      name: string,
         *      email: string,
         *      email_verified_at?: string,
         *      password: string,
         *      token: string
         *  } $data
         */
        $data = $user->toArray();
        $data['token'] = $token;

        return $data;
    }

    public function logout(User $user): void
    {
        // @phpstan-ignore-next-line
        $user->tokens()->delete();
    }
}
