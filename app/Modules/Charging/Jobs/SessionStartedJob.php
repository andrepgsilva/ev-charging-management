<?php

declare(strict_types=1);

namespace App\Modules\Charging\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Modules\Charging\Repositories\ChargingSessionRepository;

final class SessionStartedJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * @param  string  $connection
     */
    public function __construct(
        public array $payload,
        public $connection = 'rabbitmq',
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chargingSessionRepository = app(ChargingSessionRepository::class);

        $chargingSessionRepository->create([
            'charging_point_id' => $this->payload['charging_point_id'],
            'vehicle_id' => $this->payload['vehicle_id'],
            'driver_id' => $this->payload['driver_id'],
            'start_time' => $this->payload['start_time'],
            'end_time' => $this->payload['end_time'],
            'energy_kwh' => $this->payload['energy_kwh'],
            'cost' => $this->payload['cost'],
            'connector_number' => $this->payload['connector_number'],
        ]);
    }
}
