<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Shared\Traits\ApiResponseTrait;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;
use App\Modules\ChargingInfrastructure\Services\ChargingPointService;
use App\Modules\ChargingInfrastructure\Resources\ChargingPointResource;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPoint\CreateChargingPointDto;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPoint\UpdateChargingPointDto;
use App\Modules\ChargingInfrastructure\Requests\ChargingPoint\CreateChargingPointRequest;
use App\Modules\ChargingInfrastructure\Requests\ChargingPoint\UpdateChargingPointRequest;

final class ChargingPointController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ChargingPointService $chargingPointService,
    ) {
        //
    }

    /**
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $allChargingPoints = $this->chargingPointService->getAll();

        return $this->successResponse(
            $allChargingPoints->toResourceCollection(ChargingPointResource::class),
            'Charging Pools retrieved successfully'
        );
    }

    /**
     * @throws Throwable
     */
    public function show(ChargingPoint $chargingPoint): JsonResponse
    {
        return $this->successResponse(
            $chargingPoint->toResource(ChargingPointResource::class),
            'Charging Pool retrieved successfully'
        );
    }

    /**
     * @param  CreateChargingPointRequest&Request  $createChargingPointRequest
     *
     * @throws Throwable
     */
    public function store(CreateChargingPointRequest $createChargingPointRequest): JsonResponse
    {
        $createChargingPointDto = app(CreateChargingPointDto::class);

        /**
         * @var array{
         *  charging_pool_id?: int,
         *  label?: string,
         *  vendor?: string,
         *  serial_number?: string,
         *  description?: string
         * } $data
         */
        $data = $createChargingPointRequest->all();
        $createChargingPointDto->fillFromArray($data);

        $chargingPoint = $this->chargingPointService->create($createChargingPointDto);

        return $this->successResponse(
            $chargingPoint->toResource(ChargingPointResource::class),
            'Charging Pool created successfully',
            201
        );
    }

    /**
     * @param  UpdateChargingPointRequest&Request  $updateChargingPointRequest
     *
     * @throws Throwable
     */
    public function update(
        ChargingPoint $chargingPoint,
        UpdateChargingPointRequest $updateChargingPointRequest,
        UpdateChargingPointDto $updateChargingPointDto
    ): JsonResponse {
        /**
         * @var array{
         *  charging_pool_id?: int,
         *  label?: string,
         *  vendor?: string,
         *  serial_number?: string,
         *  description?: string
         * } $data
         */
        $data = $updateChargingPointRequest->all();
        $updateChargingPointDto->fillFromArray($data);

        /** @var ChargingPoint $chargingPoint */
        $chargingPoint = $this->chargingPointService->update(
            $chargingPoint,
            $updateChargingPointDto
        );

        return $this->successResponse(
            $chargingPoint->toResource(ChargingPointResource::class),
            'Charging Pool created successfully',
            201
        );
    }

    public function destroy(ChargingPoint $chargingPoint): JsonResponse
    {
        $this->chargingPointService->delete($chargingPoint);

        return $this->successResponse(
            [],
            'Charging Pool deleted successfully',
            200
        );
    }
}
