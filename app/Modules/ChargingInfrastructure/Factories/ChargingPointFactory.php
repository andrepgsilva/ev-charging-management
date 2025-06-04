<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

/**
 * @extends Factory<ChargingPoint>
 */
final class ChargingPointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<ChargingPoint>
     */
    protected $model = ChargingPoint::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => $this->faker->sentence(2),
            'vendor' => $this->faker->sentence(2),
            'serial_number' => $this->faker->numerify('######-###'),
            'description' => $this->faker->text(),
            'charging_pool_id' => ChargingPool::factory()->createOne()->id,
        ];
    }
}
