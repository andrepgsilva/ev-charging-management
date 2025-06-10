<?php

declare(strict_types=1);

namespace App\Modules\Charging\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $charging_point_id
 * @property int $vehicle_id
 * @property int $driver_id
 * @property string $start_time
 * @property ?string $end_time
 * @property ?string $energy_kwh
 * @property ?string $cost
 * @property ?int $connector_number
 */
final class ChargingSessionResource extends JsonResource
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
            'charging_point_id' => $this->charging_point_id,
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'energy_kwh' => $this->energy_kwh,
            'cost' => $this->cost,
            'connector_number' => $this->connector_number,
        ];
    }
}
