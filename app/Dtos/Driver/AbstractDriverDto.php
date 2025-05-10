<?php

declare(strict_types=1);

namespace App\Dtos\Driver;

use App\Traits\DtoTrait;

abstract class AbstractDriverDto
{
    /**
     * @use DtoTrait<array{
     *     name?: string,
     *     email?: string,
     *     phone?: string|null,
     *     company_id?: int|null
     * }>
     */
    use DtoTrait;

    /**
     * @return array{
     *     name?: string,
     *     email?: string,
     *     phone?: string|null,
     *     company_id?: int|null
     * }
     */
    final public function toArray(): array
    {
        return $this->convertToArray(true);
    }

    /**
     * @param  array{
     *     name?: string,
     *     email?: string,
     *     phone?: string|null,
     *     company_id?: int|null
     * } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
