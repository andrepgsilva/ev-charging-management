<?php

declare(strict_types=1);

namespace App\Modules\Company\Models;

use Carbon\Carbon;
use App\Models\BaseModel;
use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Company\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $tax_number
 * @property-read string|null $phone
 * @property-read string|null $address
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 */
final class Company extends BaseModel
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    /** @return HasMany<Driver, $this> */
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    /** @return HasMany<Vehicle, $this> */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): CompanyFactory
    {
        return CompanyFactory::new();
    }
}
