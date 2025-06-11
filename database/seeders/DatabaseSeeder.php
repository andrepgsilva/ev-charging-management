<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\Fleet\Models\Vehicle;
use Illuminate\Database\Seeder;

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
