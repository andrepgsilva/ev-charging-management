<?php

declare(strict_types=1);

namespace App\Modules\Charging\Services;

use App\Modules\Charging\Jobs\SessionStartedJob;
use App\Modules\Charging\Dtos\ChargerEvent\ChargerEventStartedDto;

final readonly class ChargerEventService
{
    public function started(ChargerEventStartedDto $chargerEventStartedDto): void
    {
        $chargerEventStartedData = $chargerEventStartedDto->toArray();

        SessionStartedJob::dispatch($chargerEventStartedData)->onQueue('session.started');
    }
}
