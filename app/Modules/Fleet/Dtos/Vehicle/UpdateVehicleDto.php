<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Dtos\Vehicle;

use App\Shared\Traits\DtoTrait;

final class UpdateVehicleDto
{
    /**
     * @use DtoTrait<array{
     *     make?: string,
     *     model?: string,
     *     plate_number?: string,
     *     battery_capacity_kwh?: string,
     *     company_id?: int,
     *     driver_id?: int
     * }>
     */
    use DtoTrait;

    public ?string $make;

    public ?string $model;

    public ?string $plateNumber;

    public ?string $batteryCapacityKwh;

    public ?int $companyId;

    public ?int $driverId;
}
