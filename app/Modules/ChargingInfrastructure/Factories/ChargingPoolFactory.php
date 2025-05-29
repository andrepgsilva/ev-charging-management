<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Factories;

use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\ChargingInfrastructure\Enums\ChargingPoolEnum;

/**
 * @extends Factory<ChargingPool>
 */
final class ChargingPoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<ChargingPool>
     */
    protected $model = ChargingPool::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'state' => $this->faker->city().' '.$this->faker->country(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'latitude' => $this->faker->optional()->latitude(),
            'longitude' => $this->faker->optional()->longitude(),
            'type' => $this->faker->optional()->randomElement([
                ChargingPoolEnum::PUBLIC->value,
                ChargingPoolEnum::PRIVATE->value,
                ChargingPoolEnum::COMPANY->value,
                ChargingPoolEnum::CONDOMINIUM->value,
            ]),
            'description' => $this->faker->optional()->text(),
            'company_id' => Company::factory()->createOne()->id,
        ];
    }
}
