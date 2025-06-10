<?php

declare(strict_types=1);

namespace App\Modules\Charging\Dtos\ChargingSession;

use App\Shared\Traits\DtoTrait;

abstract class AbstractChargingSessionDto
{
    /**
     * @use DtoTrait<array{
     *  charging_point_id: int,
     *  vehicle_id: int,
     *  driver_id: int,
     *  start_time: string,
     *  end_time?: string,
     *  energy_kwh?: ?string,
     *  cost?: string,
     *  connector_number: int
     * }>
     */
    use DtoTrait;

    /**
     * @return array{
     *   charging_point_id?: int,
     *   vehicle_id?: int,
     *   driver_id?: int,
     *   start_time?: string,
     *   end_time?: string,
     *   energy_kwh?: ?string,
     *   cost?: string,
     *   connector_number: int
     *  }
     */
    final public function toArray(): array
    {
        return $this->convertToArray(true);
    }

    /**
     * @param  array{
     *   charging_point_id?: int,
     *   vehicle_id?: int,
     *   driver_id?: int,
     *   start_time?: string,
     *   end_time?: string,
     *   energy_kwh?: ?string,
     *   cost?: string,
     *   connector_number?: int
     *  } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
