<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $make
 * @property string $model
 * @property string $plate_number
 * @property ?string $battery_capacity_kwh
 * @property ?int $driver_id
 * @property ?int $company_id
 */
final class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, int|string|null>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'plate_number' => $this->plate_number,
            'battery_capacity_kwh' => $this->battery_capacity_kwh,
            'driver_id' => $this->driver_id,
            'company_id' => $this->company_id,
        ];
    }
}
