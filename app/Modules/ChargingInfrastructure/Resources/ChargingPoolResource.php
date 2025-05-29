<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $address
 * @property-read string $country
 * @property-read string $state
 * @property-read string $city
 * @property-read string $postal_code
 * @property-read ?string $latitude
 * @property-read ?string $longitude
 * @property-read ?string $type
 * @property-read ?string $description
 * @property-read ?int $company_id
 */
final class ChargingPoolResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'type' => $this->type,
            'description' => $this->description,
            'company_id' => $this->company_id,
        ];
    }
}
