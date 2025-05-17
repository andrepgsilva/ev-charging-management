<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Factories;

use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
final class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->company,
            'model' => $this->faker->word,
            'plate_number' => $this->faker->unique()->numerify('#########'),
            'battery_capacity_kwh' => $this->faker->numberBetween(50, 100),
            'driver_id' => Driver::factory()->createOne()->id,
            'company_id' => Company::factory()->createOne()->id,
        ];
    }
}
