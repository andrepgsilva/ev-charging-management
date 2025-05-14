<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class CreateChargingSessionMonthlyPartitionTable extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:create-charging-session-monthly-partition-table';

    /**
     * The console command description.
     */
    protected $description = 'Create a monthly partition table for the charging_sessions table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Artisan command pseudocode
        $nextMonth = now()->addMonth()->format('Y_m');
        $start = now()->addMonth()->startOfMonth()->toDateString();
        $end = now()->addMonth()->endOfMonth()->addDay()->toDateString();

        DB::statement("
            CREATE TABLE charging_sessions_{$nextMonth} PARTITION OF charging_sessions
            FOR VALUES FROM ('$start') TO ('$end');
        ");
    }
}
