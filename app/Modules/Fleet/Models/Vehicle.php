<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Models;

use Carbon\Carbon;
use App\Models\BaseModel;
use App\Modules\Company\Models\Company;
use App\Modules\Fleet\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read int $id
 * @property-read string $make
 * @property-read string $model
 * @property-read string $plate_number
 * @property-read string $battery_capacity_kwh
 * @property-read int|null $driver_id
 * @property-read int|null $company_id
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 */
final class Vehicle extends BaseModel
{
    /** @use HasFactory<VehicleFactory> */
    use HasFactory;

    /** @return BelongsTo<Driver, $this> */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    /** @return BelongsTo<Company, $this> */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected static function newFactory(): VehicleFactory
    {
        return VehicleFactory::new();
    }
}
