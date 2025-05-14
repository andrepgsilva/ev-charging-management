<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

it('creates a monthly partition table for charging_sessions', function () {
    // Prepare the expected table name
    $nextMonth = Carbon::now()->addMonth()->format('Y_m');
    $expectedTableName = "charging_sessions_{$nextMonth}";

    // Run the artisan command
    Artisan::call('app:create-charging-session-monthly-partition-table');

    // Verify the table has been created
    $tableExists = DB::select("SELECT to_regclass('public.{$expectedTableName}')") !== null;

    // Assert that the table was created
    expect($tableExists)->toBeTrue();
});
