<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Fleet\Models\Vehicle;
use App\Shared\Authentication\Models\User;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Vehicle::factory()->count(1)->create();
        ChargingPoint::factory()->count(1)->create();
    }
}
