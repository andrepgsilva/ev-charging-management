<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Dtos\Driver;

use App\Shared\Traits\DtoTrait;

final class UpdateDriverDto
{
    /**
     * @use DtoTrait<array{
     *     name?: string,
     *     email?: string,
     *     phone?: string,
     *     company_id?: int
     * }>
     */
    use DtoTrait;

    public ?string $name;

    public ?string $email;

    public ?string $phone;

    public ?int $companyId;
}
