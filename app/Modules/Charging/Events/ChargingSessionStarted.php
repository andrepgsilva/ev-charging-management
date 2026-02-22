<?php

declare(strict_types=1);

namespace App\Modules\Charging\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Modules\Charging\Models\ChargingSession;
use Illuminate\Broadcasting\InteractsWithSockets;

final class ChargingSessionStarted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public ChargingSession $chargingSession
    ) {
        //
    }
}
