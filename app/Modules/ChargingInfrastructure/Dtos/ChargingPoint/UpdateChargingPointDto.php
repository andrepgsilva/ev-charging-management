<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Dtos\ChargingPoint;

use App\Shared\Traits\DtoTrait;

final class UpdateChargingPointDto
{
    /**
     * @use DtoTrait<array{
     *  charging_pool_id?: int,
     *  label?: string,
     *  vendor?: string,
     *  serial_number?: string,
     *  description?: string
     * }>
     */
    use DtoTrait;

    public ?int $chargingPoolId;

    public ?string $label;

    public ?string $vendor;

    public ?string $serialNumber;

    public ?string $description;
}
