<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\ChargingPool\Models;

use App\Models\BaseModel;
use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\ChargingInfrastructure\ChargingPool\Factories\ChargingPoolFactory;

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
final class ChargingPool extends BaseModel
{
    /**
     * @use HasFactory<ChargingPoolFactory>
     */
    use HasFactory;

    /**
     * @return BelongsTo<Company, $this>
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): ChargingPoolFactory
    {
        return ChargingPoolFactory::new();
    }
}
