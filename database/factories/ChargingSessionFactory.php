<?php

declare(strict_types=1);

namespace Database\Factories;

use Carbon\Carbon;
use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Company\Models\Company;
use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChargingSessionFactory>
 */
final class ChargingSessionFactory extends Factory
{
    protected $model = ChargingSession::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory()->createOne()->id,
            'vehicle_id' => Vehicle::factory()->createOne()->id,
            'driver_id' => Driver::factory()->createOne()->id,
            'location_id' => null,
            'start_time' => Carbon::now(),
            'end_time' => null,
            'energy_kwh' => $this->faker->optional()->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['started', 'ended', 'failed']),
        ];
    }
}
