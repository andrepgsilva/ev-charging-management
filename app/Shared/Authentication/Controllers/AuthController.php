<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Shared\Traits\ApiResponseTrait;
use App\Shared\Authentication\Models\User;
use Illuminate\Validation\ValidationException;
use App\Shared\Authentication\Services\AuthService;
use App\Shared\Authentication\Requests\LoginRequest;
use App\Shared\Authentication\Dtos\Auth\UserLoginDto;

final class AuthController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly AuthService $authService,
    ) {
        //
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        /**
         * @var array{
         *  name: string,
         *  password: string
         * } $data
         */
        $data = $request->all();

        $userLoginDto = app(UserLoginDto::class);
        $userLoginDto->fill($data);

        $data = $this->authService->login($userLoginDto);

        return $this->successResponse(
            $data,
            'Login successful',
            200
        );
    }

    public function logout(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $this->authService->logout($user);

        return $this->successResponse(
            [],
            'Logout successful',
            200
        );
    }
}
