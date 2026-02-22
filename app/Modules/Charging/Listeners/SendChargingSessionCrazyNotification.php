<?php

declare(strict_types=1);

namespace App\Modules\Charging\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Modules\Charging\Events\ChargingSessionStarted;

final class SendChargingSessionStartedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChargingSessionStarted $event): void
    {
        //
    }
}
