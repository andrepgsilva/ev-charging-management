<?php

declare(strict_types=1);

namespace App\Modules\Charging\Models;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use App\Modules\Company\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read int $id
 * @property-read int $company_id
 * @property-read int $vehicle_id
 * @property-read ?int $driver_id
 * @property-read int $location_id
 * @property-read Carbon $start_time
 * @property-read ?Carbon $end_time
 * @property-read ?string $energy_kwh
 * @property-read ?string $status
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 */
final class ChargingSession extends BaseModel
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    //    protected static function newFactory(): ChargingSessionFactory
    //    {
    //        return ChargingSessionFactory::new();
    //    }
}
