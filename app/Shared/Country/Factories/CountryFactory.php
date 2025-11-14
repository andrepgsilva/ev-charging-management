<?php

declare(strict_types=1);

namespace App\Shared\Country\Factories;

use App\Shared\Country\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Country>
 */
final class CountryFactory extends Factory
{
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'iso' => $this->faker->unique()->countryCode(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
