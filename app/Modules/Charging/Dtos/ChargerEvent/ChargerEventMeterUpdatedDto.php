<?php

declare(strict_types=1);

namespace App\Modules\Charging\Dtos\ChargerEvent;

use App\Shared\Traits\DtoTrait;

final class ChargerEventStartedDto
{
    /**
     * @use DtoTrait<array{
     *  event: string,
     *  chargerId: int,
     *  sessionId: int,
     *  vehicleId: int,
     *  driverId: int,
     *  startedAt: string,
     * }>
     */
    use DtoTrait;

    public string $event;

    public int $chargerId;

    public int $sessionId;

    public int $vehicleId;

    public int $driverId;

    public int $startedAt;
}
