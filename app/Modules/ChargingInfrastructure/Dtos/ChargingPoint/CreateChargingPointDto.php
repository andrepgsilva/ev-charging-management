<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Dtos\ChargingPoint;

final class CreateChargingPointDto extends AbstractChargingPointDto
{
    public ?int $chargingPoolId;

    public string $label;

    public ?string $vendor;

    public ?string $serialNumber;

    public ?string $description;
}
