<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Carbon::setTestNow('2024-03-15 12:00:00');
});

afterEach(function () {
    Carbon::setTestNow();
});

it('creates a monthly partition table for charging_sessions when table exists', function () {
    Schema::shouldReceive('hasTable')
        ->once()
        ->with('charging_sessions')
        ->andReturn(true);

    $nextMonth = Carbon::now()->addMonth()->format('Y_m');
    $expectedTableName = "charging_sessions_{$nextMonth}";
    $start = Carbon::now()->addMonth()->startOfMonth()->toDateString();
    $end = Carbon::now()->addMonth()->endOfMonth()->addDay()->toDateString();

    $expectedQuery = "CREATE TABLE charging_sessions_{$nextMonth}";
    $expectedQuery .= ' PARTITION OF charging_sessions';
    $expectedQuery .= " FOR VALUES FROM ('$start') TO ('$end')";

    DB::shouldReceive('statement')
        ->once()
        ->with(mb_trim($expectedQuery));

    $result = Artisan::call('app:create-charging-session-monthly-partition-table');

    expect($result)->toBe(0);
});

it('does not create partition when charging_sessions table does not exist', function () {
    Schema::shouldReceive('hasTable')
        ->once()
        ->with('charging_sessions')
        ->andReturn(false);

    $result = Artisan::call('app:create-charging-session-monthly-partition-table');

    expect($result)->toBe(0);
});
