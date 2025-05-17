<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Dtos\Driver;

final class CreateDriverDto extends AbstractDriverDto
{
    public string $name;

    public string $email;

    public ?string $phone;

    public ?string $companyId;
}
