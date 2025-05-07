<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
final class VehicleFactory extends Factory
{
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
