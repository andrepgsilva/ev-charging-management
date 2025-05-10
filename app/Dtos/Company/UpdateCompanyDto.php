<?php

declare(strict_types=1);

namespace App\Dtos\Company;

final class UpdateCompanyDto extends AbstractCompanyDto
{
    public ?string $name;

    public ?string $email;

    public ?string $taxNumber;

    public ?string $phone;

    public ?string $address;
}
