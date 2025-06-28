<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Dtos\User;

use App\Shared\Traits\DtoTrait;

final class UpdateUserDto
{
    /**
     * @use DtoTrait<array{
     *     name?: string,
     *     email?: string,
     *     email_verified_at?: string,
     *     password?: string,
     *     remember_token?: string
     * }>
     */
    use DtoTrait;

    public ?string $name;

    public ?string $email;

    public ?string $email_verified_at;

    public ?string $password;

    public ?string $remember_token;
}
