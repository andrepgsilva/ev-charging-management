<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Dtos\Vehicle;

final class UpdateVehicleDto extends AbstractVehicleDto
{
    public ?string $make;

    public ?string $model;

    public ?string $plateNumber;

    public ?string $batteryCapacityKwh;

    public ?int $companyId;

    public ?int $driverId;
}
