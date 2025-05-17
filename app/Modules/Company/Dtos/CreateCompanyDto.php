<?php

declare(strict_types=1);

namespace App\Modules\Company\Dtos;

final class CreateCompanyDto extends AbstractCompanyDto
{
    public string $name;

    public string $email;

    public string $taxNumber;

    public ?string $phone;

    public ?string $address;
}
