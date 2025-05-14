<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('
            CREATE TABLE charging_sessions_2025_05 PARTITION OF charging_sessions
            FOR VALUES FROM (\'2025-05-01\') TO (\'2025-06-01\');
        ');
    }

    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS charging_sessions_2025_05;');
    }
};
