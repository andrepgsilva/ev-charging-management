<?php

declare(strict_types=1);

namespace App\Modules\Charging\Factories;

use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

/**
 * @extends Factory<ChargingSession>
 */
final class ChargingSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<ChargingSession>
     */
    protected $model = ChargingSession::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'charging_point_id' => ChargingPoint::factory()->createOne()->id,
            'vehicle_id' => Vehicle::factory()->createOne()->id,
            'driver_id' => Driver::factory()->createOne()->id,
            'start_time' => now(),
            'end_time' => now()->addHour(),
            'energy_kwh' => $this->faker->randomFloat(8, 2, 8000),
            'cost' => $this->faker->randomFloat(8, 2, 4000),
            'connector_number' => $this->faker->numberBetween(1, 3),
        ];
    }
}
