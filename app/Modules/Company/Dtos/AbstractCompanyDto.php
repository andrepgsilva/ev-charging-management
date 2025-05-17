<?php

declare(strict_types=1);

namespace App\Modules\Company\Dtos;

use App\Shared\Traits\DtoTrait;

abstract class AbstractCompanyDto
{
    /**
     * @use DtoTrait<array{
     *     name?: string,
     *     email?: string,
     *     tax_number?: string,
     *     phone?: string|null,
     *     address?: string|null
     * }>
     */
    use DtoTrait;

    /**
     * @return array{
     *  name?: string,
     *  email?: string,
     *  tax_number?: string,
     *  phone?: string|null,
     *  address?: string|null
     * }
     */
    final public function toArray(): array
    {
        return $this->convertToArray(true);
    }

    /**
     * @param  array{
     *  name?: string,
     *  email?: string,
     *  tax_number?: string,
     *  phone?: string,
     *  address?: string
     * } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
