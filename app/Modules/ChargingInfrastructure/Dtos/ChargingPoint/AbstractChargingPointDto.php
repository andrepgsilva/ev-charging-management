<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Dtos\ChargingPoint;

use App\Shared\Traits\DtoTrait;

abstract class AbstractChargingPointDto
{
    /**
     * @use DtoTrait<array{
     *  charging_pool_id?: int,
     *  label: string,
     *  vendor?: string,
     *  serial_number?: string,
     *  description?: string
     * }>
     */
    use DtoTrait;

    /**
     * @return array{
     *  charging_pool_id?: int,
     *  label?: string,
     *  vendor?: string,
     *  serial_number?: string,
     *  description?: string
     * }
     */
    final public function toArray(): array
    {
        return $this->convertToArray(true);
    }

    /**
     * @param  array{
     *  charging_pool_id?: int,
     *  label?: string,
     *  vendor?: string,
     *  serial_number?: string,
     *  description?: string
     * } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
