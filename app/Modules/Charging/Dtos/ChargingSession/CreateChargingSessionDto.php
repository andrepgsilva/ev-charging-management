<?php

declare(strict_types=1);

namespace App\Modules\Charging\Dtos\ChargingSession;

final class CreateChargingSessionDto extends AbstractChargingSessionDto
{
    public int $chargingPointId;

    public int $vehicleId;

    public int $driverId;

    public string $startTime;

    public ?string $endTime;

    public ?string $energyKwh;

    public ?string $cost;

    public int $connectorNumber;
}
