<?php

declare(strict_types=1);

namespace App\Modules\Charging\Dtos\ChargingSession;

use App\Shared\Traits\DtoTrait;

final class UpdateChargingSessionDto
{
    /**
     * @use DtoTrait<array{
     *  charging_point_id?: int,
     *  vehicle_id?: int,
     *  driver_id?: int,
     *  start_time?: string,
     *  end_time?: string,
     *  energy_kwh?: ?string,
     *  cost?: string,
     *  connector_number?: int
     * }>
     */
    use DtoTrait;

    public ?int $chargingPointId;

    public ?int $vehicleId;

    public ?int $driverId;

    public ?string $startTime;

    public ?string $endTime;

    public ?string $energyKwh;

    public ?string $cost;

    public ?int $connectorNumber;
}
