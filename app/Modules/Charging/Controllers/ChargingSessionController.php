<?php

declare(strict_types=1);

namespace App\Modules\Charging\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Shared\Traits\ApiResponseTrait;
use App\Modules\Charging\Models\ChargingSession;
use App\Modules\Charging\Services\ChargingSessionService;
use App\Modules\Charging\Resources\ChargingSessionResource;
use App\Modules\Charging\Dtos\ChargingSession\CreateChargingSessionDto;
use App\Modules\Charging\Dtos\ChargingSession\UpdateChargingSessionDto;
use App\Modules\Charging\Requests\ChargingSession\CreateChargingSessionRequest;
use App\Modules\Charging\Requests\ChargingSession\UpdateChargingSessionRequest;

final class ChargingSessionController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ChargingSessionService $chargingSessionService,
    ) {
        //
    }

    /**
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $allCompanies = $this->chargingSessionService->getAll();

        return $this->successResponse(
            $allCompanies->toResourceCollection(ChargingSessionResource::class),
            'Companies retrieved successfully'
        );
    }

    /**
     * @throws Throwable
     */
    public function show(ChargingSession $chargingSession): JsonResponse
    {
        return $this->successResponse(
            $chargingSession->toResource(ChargingSessionResource::class),
            'ChargingSession retrieved successfully'
        );
    }

    /**
     * @param  CreateChargingSessionRequest&Request  $createChargingSessionRequest
     *
     * @throws Throwable
     */
    public function store(CreateChargingSessionRequest $createChargingSessionRequest): JsonResponse
    {
        $createChargingSessionDto = app(CreateChargingSessionDto::class);

        /**
         * @var array{
         *  charging_point_id: int,
         *  vehicle_id: int,
         *  driver_id: int,
         *  start_time: string,
         *  end_time?: string,
         *  energy_kwh?: ?string,
         *  cost?: string,
         *  connector_number: int
         * } $data
         */
        $data = $createChargingSessionRequest->all();
        $createChargingSessionDto->fillFromArray($data);

        $chargingSession = $this->chargingSessionService->create($createChargingSessionDto);

        return $this->successResponse(
            $chargingSession->toResource(ChargingSessionResource::class),
            'ChargingSession created successfully',
            201
        );
    }

    /**
     * @param  UpdateChargingSessionRequest&Request  $updateChargingSessionRequest
     *
     * @throws Throwable
     */
    public function update(
        ChargingSession $chargingSession,
        UpdateChargingSessionRequest $updateChargingSessionRequest,
        UpdateChargingSessionDto $updateChargingSessionDto
    ): JsonResponse {
        /**
         * @var array{
         *  charging_point_id?: int,
         *  vehicle_id?: int,
         *  driver_id?: int,
         *  start_time?: string,
         *  end_time?: string,
         *  energy_kwh?: ?string,
         *  cost?: string,
         *  connector_number?: int
         * } $data
         */
        $data = $updateChargingSessionRequest->all();
        $updateChargingSessionDto->fillFromArray($data);

        /** @var ChargingSession $chargingSession */
        $chargingSession = $this->chargingSessionService->update(
            $chargingSession,
            $updateChargingSessionDto
        );

        return $this->successResponse(
            $chargingSession->toResource(ChargingSessionResource::class),
            'ChargingSession created successfully',
            201
        );
    }

    public function destroy(ChargingSession $chargingSession): JsonResponse
    {
        $this->chargingSessionService->delete($chargingSession);

        return $this->successResponse(
            [],
            'ChargingSession deleted successfully',
            200
        );
    }
}
