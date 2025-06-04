<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Dtos\ChargingPool;

final class CreateChargingPoolDto extends AbstractChargingPoolDto
{
    public string $name;

    public string $address;

    public string $country;

    public string $state;

    public string $city;

    public string $postalCode;

    public ?string $latitude;

    public ?string $longitude;

    public ?string $type;

    public ?string $description;

    public ?int $companyId;
}
