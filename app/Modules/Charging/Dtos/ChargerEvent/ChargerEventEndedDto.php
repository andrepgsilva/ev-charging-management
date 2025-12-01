<?php

declare(strict_types=1);

namespace App\Modules\Charging\Dtos\ChargerEvent;

use App\Shared\Traits\DtoTrait;

final class ChargerEventMeterUpdatedDto
{
    /**
     * @use DtoTrait<array{
     *  event: string,
     *  sessionId: int,
     *  meterKwh: string,
     *  timestamp: string
     * }>
     */
    use DtoTrait;

    public string $event;

    public int $sessionId;

    public string $meterKwh;

    public int $timestamp;
}
