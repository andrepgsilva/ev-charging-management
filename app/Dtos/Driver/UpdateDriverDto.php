<?php

declare(strict_types=1);

namespace App\Dtos\Driver;

final class UpdateDriverDto extends AbstractDriverDto
{
    public ?string $name;

    public ?string $email;

    public ?string $phone;

    public ?string $companyId;
}
