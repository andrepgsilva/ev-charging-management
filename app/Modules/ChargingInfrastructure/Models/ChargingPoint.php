<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\ChargingInfrastructure\Factories\ChargingPointFactory;

/**
 * @property-read int $id
 * @property-read string $label
 * @property-read ?string $vendor
 * @property-read ?string $serial_number
 * @property-read ?string $description
 * @property-read ?int $charging_pool_id
 * @property-read ?ChargingPool $chargingPool
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 * */
final class ChargingPoint extends BaseModel
{
    /**
     * @use HasFactory<ChargingPointFactory>
     */
    use HasFactory;

    /**
     * @return BelongsTo<ChargingPool, $this>
     */
    public function chargingPool(): BelongsTo
    {
        return $this->belongsTo(ChargingPool::class);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): ChargingPointFactory
    {
        return ChargingPointFactory::new();
    }
}
