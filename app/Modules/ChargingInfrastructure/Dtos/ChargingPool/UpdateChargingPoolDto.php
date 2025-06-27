<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Dtos\ChargingPool;

use App\Shared\Traits\DtoTrait;

final class UpdateChargingPoolDto
{
    /**
     * @use DtoTrait<array{
     *  name?: string,
     *  address?: string,
     *  country?: string,
     *  state?: string,
     *  city?: string,
     *  postal_code?: string,
     *  latitude?: string,
     *  longitude?: string,
     *  type?: string,
     *  description?: string,
     *  company_id?: string,
     * }>
     */
    use DtoTrait;

    public ?string $name;

    public ?string $address;

    public ?string $country;

    public ?string $state;

    public ?string $city;

    public ?string $postalCode;

    public ?string $latitude;

    public ?string $longitude;

    public ?string $type;

    public ?string $description;

    public ?int $companyId;
}
