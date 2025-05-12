<?php

declare(strict_types=1);

namespace App\Dtos\Vehicle;

final class CreateVehicleDto extends AbstractVehicleDto
{
    public string $make;

    public string $model;

    public string $plateNumber;

    public ?string $batteryCapacityKwh;

    public ?int $companyId;

    public ?int $driverId;
}
