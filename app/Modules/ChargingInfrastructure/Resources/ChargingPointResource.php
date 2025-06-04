<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read ?int $charging_pool_id
 * @property-read ?string $label
 * @property-read ?string $vendor
 * @property-read ?string $serial_number
 * @property-read ?string $description
 */
final class ChargingPointResource extends JsonResource
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
            'charging_pool_id' => $this->charging_pool_id,
            'label' => $this->label,
            'vendor' => $this->vendor,
            'serial_number' => $this->serial_number,
            'description' => $this->description,
        ];
    }
}
