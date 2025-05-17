<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Dtos\Vehicle;

use App\Shared\Traits\DtoTrait;

abstract class AbstractVehicleDto
{
    /**
     * @use DtoTrait<array{
     *     make?: string,
     *     model?: string,
     *     plate_number?: string,
     *     battery_capacity_kwh?: string,
     *     company_id?: int,
     *     driver_id?: int
     * }>
     */
    use DtoTrait;

    /**
     * @return array{
     *     make?: string,
     *     model?: string,
     *     plate_number?: string,
     *     battery_capacity_kwh?: string,
     *     company_id?: int,
     *     driver_id?: int
     * }
     */
    final public function toArray(): array
    {
        return $this->convertToArray(true);
    }

    /**
     * @param  array{
     *     make?: string,
     *     model?: string,
     *     plate_number?: string,
     *     battery_capacity_kwh?: string,
     *     company_id?: int,
     *     driver_id?: int
     * } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
