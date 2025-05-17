<?php

declare(strict_types=1);

namespace App\Modules\Company\Factories;

use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
final class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Company>
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'tax_number' => $this->faker->unique()->numerify('#########'),
            'phone' => $this->faker->optional()->phoneNumber,
            'address' => $this->faker->optional()->address,
        ];
    }
}
