<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Shared\Traits\ApiResponseTrait;
use App\Shared\Authentication\Models\User;
use App\Shared\Authentication\Services\UserService;
use App\Shared\Authentication\Resources\UserResource;
use App\Shared\Authentication\Dtos\User\CreateUserDto;
use App\Shared\Authentication\Dtos\User\UpdateUserDto;
use App\Shared\Authentication\Requests\CreateUserRequest;
use App\Shared\Authentication\Requests\UpdateUserRequest;

final class UserController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly UserService $userService,
    ) {
        //
    }

    /**
     * @throws Throwable
     */
    public function store(CreateUserRequest $createUserRequest): JsonResponse
    {
        $createUserDto = app(CreateUserDto::class);

        /**
         * @var array{
         *  name: string,
         *  email: string,
         *  email_verified_at?: string,
         *  password: string,
         *  remember_token?: string,
         * } $data
         */
        $data = $createUserRequest->all();
        $createUserDto->fill($data);

        $user = $this->userService->create($createUserDto);

        return $this->successResponse(
            $user->toResource(UserResource::class),
            'User created successfully',
            201
        );
    }

    /**
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $allUsers = $this->userService->getAll();

        return $this->successResponse(
            $allUsers->toResourceCollection(UserResource::class),
            'Users retrieved successfully'
        );
    }

    /**
     * @throws Throwable
     */
    public function show(User $user): JsonResponse
    {
        return $this->successResponse(
            $user->toResource(UserResource::class),
            'User retrieved successfully'
        );
    }

    /**
     * @param  UpdateUserRequest&Request  $updateUserRequest
     *
     * @throws Throwable
     */
    public function update(
        User $user,
        UpdateUserRequest $updateUserRequest,
        UpdateUserDto $updateUserDto
    ): JsonResponse {
        /**
         * @var array{
         *  name?: string,
         *  email?: string,
         *  email_verified_at?: string,
         *  password?: string,
         *  remember_token?: string,
         * } $data
         */
        $data = $updateUserRequest->all();
        $updateUserDto->fill($data);

        /** @var User $user */
        $user = $this->userService->update(
            $user,
            $updateUserDto
        );

        return $this->successResponse(
            $user->toResource(UserResource::class),
            'User created successfully',
            201
        );
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->delete($user);

        return $this->successResponse(
            [],
            'User deleted successfully',
            200
        );
    }
}
