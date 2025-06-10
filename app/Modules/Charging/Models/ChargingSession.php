<?php

declare(strict_types=1);

namespace App\Modules\Charging\Models;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Charging\Factories\ChargingSessionFactory;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

/**
 * @property-read int $id
 * @property-read int $charging_point_id
 * @property-read int $vehicle_id
 * @property-read int $driver_id
 * @property-read Carbon $start_time
 * @property-read ?Carbon $end_time
 * @property-read ?string $energy_kwh
 * @property-read ?string $cost
 * @property-read ?int $connector_number
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 * @property-read Driver $driver
 * @property-read Vehicle $vehicle
 * @property-read ChargingPoint $chargingPoint
 */
final class ChargingSession extends BaseModel
{
    /** @use HasFactory<ChargingSessionFactory> */
    use HasFactory;

    /** @return BelongsTo<ChargingPoint, $this> */
    public function chargingPoint(): BelongsTo
    {
        return $this->belongsTo(ChargingPoint::class);
    }

    /** @return BelongsTo<Vehicle, $this> */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /** @return BelongsTo<Driver, $this> */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    protected static function newFactory(): ChargingSessionFactory
    {
        return ChargingSessionFactory::new();
    }
}
