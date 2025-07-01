<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Dtos\Auth;

use App\Shared\Traits\DtoTrait;

final class UserLoginDto
{
    /**
     * @use DtoTrait<array{
     *     email?: string,
     *     password: string,
     * }>
     */
    use DtoTrait;

    public string $email;

    public string $password;
}
