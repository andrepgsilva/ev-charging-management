<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
            CREATE TABLE charging_sessions (
                id BIGSERIAL NOT NULL,
                company_id BIGINT NOT NULL,
                vehicle_id BIGINT NOT NULL,
                driver_id BIGINT,
                location_id BIGINT,
                start_time TIMESTAMP NOT NULL,
                end_time TIMESTAMP,
                energy_kwh NUMERIC(10,2),
                status VARCHAR(32),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT fk_company FOREIGN KEY (company_id) REFERENCES companies(id),
                CONSTRAINT fk_vehicle FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
                CONSTRAINT fk_driver FOREIGN KEY (driver_id) REFERENCES drivers(id)
            ) PARTITION BY RANGE (start_time);
        ');

        DB::statement('CREATE INDEX idx_charging_sessions_company_id ON charging_sessions (company_id);');
        DB::statement('CREATE INDEX idx_charging_sessions_vehicle_id ON charging_sessions (vehicle_id);');
        DB::statement('CREATE INDEX idx_charging_sessions_location_id ON charging_sessions (location_id);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE charging_sessions;');
    }
};
