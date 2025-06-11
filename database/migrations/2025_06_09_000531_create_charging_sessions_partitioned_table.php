<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

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
                charging_point_id BIGINT NOT NULL,
                vehicle_id BIGINT NOT NULL,
                driver_id BIGINT NOT NULL,
                start_time TIMESTAMP NOT NULL,
                end_time TIMESTAMP,
                energy_kwh NUMERIC(10,2),
                cost NUMERIC(19,4),
                connector_number SMALLINT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT fk_charging_point FOREIGN KEY (charging_point_id) REFERENCES charging_points(id),
                CONSTRAINT fk_vehicle FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
                CONSTRAINT fk_driver FOREIGN KEY (driver_id) REFERENCES drivers(id)
            ) PARTITION BY RANGE (start_time);
        ');

        DB::statement('CREATE INDEX idx_charging_sessions_vehicle_id ON charging_sessions (vehicle_id);');
        DB::statement('CREATE UNIQUE INDEX uniq_charging_sessions_id_start_time ON charging_sessions (id, start_time);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_sessions');
    }
};
