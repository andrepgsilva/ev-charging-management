<?php

declare(strict_types=1);

namespace App\Modules\Charging\Controllers;

use Illuminate\Http\JsonResponse;
use App\Shared\Traits\ApiResponseTrait;
use App\Modules\Charging\Dtos\ChargerEvent\ChargerEventStartedDto;
use App\Modules\Charging\Requests\ChargerEvent\ChargerEventStartedRequest;
use App\Modules\Charging\Services\ChargerEventService;

final class ChargerEventController
{
    use ApiResponseTrait;

    /**
     * @throws Throwable
     */
    public function sessionStarted(ChargerEventStartedRequest $chargerEventStartedRequest): JsonResponse
    {
        $chargerEventStartedDto = app(ChargerEventStartedDto::class);


        /**
         * @var array{
         *  chargingPointId: int,
         *  vehicleId: int,
         *  driverId: int,
         *  startTime: string,
         *  endTime: string,
         *  energyKwh: string,
         *  cost: string,
         *  connectorNumber: int,
         * }
         */
        $data = $chargerEventStartedRequest->all();
        $chargerEventStartedDto->fill($data);

        $chargerEventService = app(ChargerEventService::class);

        $chargerEventService->started($chargerEventStartedDto);

        return $this->successResponse(
            [],
            'ChargerEventStarted message processed.'
        );
    }
}
