<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Dtos\Driver;

use App\Shared\Traits\DtoTrait;

abstract class AbstractDriverDto
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

    /**
     * @return array{
     *     name?: string,
     *     email?: string,
     *     phone?: string,
     *     company_id?: int
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
     *     phone?: string,
     *     company_id?: int
     * } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
