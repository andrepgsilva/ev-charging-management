<?php

declare(strict_types=1);

namespace App\Modules\Charging\Models;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use Database\Factories\ChargingSessionFactory;
use App\Modules\Company\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $company_id
 * @property int $vehicle_id
 * @property ?int $driver_id
 * @property int $location_id
 * @property Carbon $start_time
 * @property ?Carbon $end_time
 * @property ?string $energy_kwh
 * @property ?string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class ChargingSession extends BaseModel
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'vehicle_id',
        'driver_id',
        'location_id',
        'start_time',
        'end_time',
        'energy_kwh',
        'status',
    ];

    protected static function newFactory(): ChargingSessionFactory
    {
        return ChargingSessionFactory::new();
    }
}
