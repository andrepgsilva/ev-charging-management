<?php

declare(strict_types=1);

namespace App\Modules\Charging\Dtos\ChargerEvent;

use App\Shared\Traits\DtoTrait;

final class ChargerEventStartedDto
{
    /**
     * @use DtoTrait<array{
     *  chargingPointId: int,
     *  vehicleId: int,
     *  driverId: int,
     *  startTime: string,
     *  endTime: string,
     *  energyKwh: string,
     *  cost: string,
     *  connectorNumber: int,
     * }>
     */
    use DtoTrait;

    public int $chargingPointId;

    public int $vehicleId;

    public int $driverId;

    public string $startTime;

    public string $endTime;

    public string $energyKwh;

    public string $cost;

    public int $connectorNumber;
}
