<?php

declare(strict_types=1);

namespace App\Modules\Company\Dtos;

use App\Shared\Traits\DtoTrait;

final class CreateCompanyDto
{
    /**
     * @use DtoTrait<array{
     *     name?: string,
     *     email?: string,
     *     tax_number: string,
     *     phone: string,
     *     address: string
     * }>
     */
    use DtoTrait;

    public string $name;

    public string $email;

    public string $taxNumber;

    public ?string $phone;

    public ?string $address;
}
