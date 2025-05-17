<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Models;

use App\Models\BaseModel;
use App\Models\Company;
use Carbon\Carbon;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $make
 * @property string $model
 * @property string $plate_number
 * @property string $battery_capacity_kwh
 * @property int|null $driver_id
 * @property int|null $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class Vehicle extends BaseModel
{
    /** @use HasFactory<VehicleFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'make',
        'model',
        'plate_number',
        'battery_capacity_kwh',
        'driver_id',
        'company_id',
    ];

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
}
