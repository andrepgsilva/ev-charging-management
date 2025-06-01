<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Shared\Traits\ApiResponseTrait;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\ChargingInfrastructure\Services\ChargingPoolService;
use App\Modules\ChargingInfrastructure\Resources\ChargingPoolResource;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPool\CreateChargingPoolDto;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPool\UpdateChargingPoolDto;
use App\Modules\ChargingInfrastructure\Requests\ChargingPool\CreateChargingPoolRequest;
use App\Modules\ChargingInfrastructure\Requests\ChargingPool\UpdateChargingPoolRequest;

final class ChargingPoolController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ChargingPoolService $chargingPoolService,
    ) {
        //
    }

    /**
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $allChargingPools = $this->chargingPoolService->getAll();

        return $this->successResponse(
            $allChargingPools->toResourceCollection(ChargingPoolResource::class),
            'Charging Pools retrieved successfully'
        );
    }

    /**
     * @throws Throwable
     */
    public function show(ChargingPool $chargingPool): JsonResponse
    {
        return $this->successResponse(
            $chargingPool->toResource(ChargingPoolResource::class),
            'Charging Pool retrieved successfully'
        );
    }

    /**
     * @param  CreateChargingPoolRequest&Request  $createChargingPoolRequest
     *
     * @throws Throwable
     */
    public function store(CreateChargingPoolRequest $createChargingPoolRequest): JsonResponse
    {
        $createChargingPoolDto = app(CreateChargingPoolDto::class);

        /**
         * @var array{
         *  name: string,
         *  address: string,
         *  country: string,
         *  state: string,
         *  city: string,
         *  postal_code: string,
         *  latitude?: string,
         *  longitude?: string,
         *  type?: string,
         *  description?: string,
         *  company_id?: string,
         * } $data
         */
        $data = $createChargingPoolRequest->all();
        $createChargingPoolDto->fillFromArray($data);

        $chargingPool = $this->chargingPoolService->create($createChargingPoolDto);

        return $this->successResponse(
            $chargingPool->toResource(ChargingPoolResource::class),
            'Charging Pool created successfully',
            201
        );
    }

    /**
     * @param  UpdateChargingPoolRequest&Request  $updateChargingPoolRequest
     *
     * @throws Throwable
     */
    public function update(
        ChargingPool $chargingPool,
        UpdateChargingPoolRequest $updateChargingPoolRequest,
        UpdateChargingPoolDto $updateChargingPoolDto
    ): JsonResponse {
        /**
         * @var array{
         *  name: string,
         *  address: string,
         *  country: string,
         *  state: string,
         *  city: string,
         *  postal_code: string,
         *  latitude?: string,
         *  longitude?: string,
         *  type?: string,
         *  description?: string,
         *  company_id?: string,
         * } $data
         */
        $data = $updateChargingPoolRequest->all();
        $updateChargingPoolDto->fillFromArray($data);

        /** @var ChargingPool $chargingPool */
        $chargingPool = $this->chargingPoolService->update(
            $chargingPool,
            $updateChargingPoolDto
        );

        return $this->successResponse(
            $chargingPool->toResource(ChargingPoolResource::class),
            'Charging Pool created successfully',
            201
        );
    }

    public function destroy(ChargingPool $chargingPool): JsonResponse
    {
        $this->chargingPoolService->delete($chargingPool);

        return $this->successResponse(
            [],
            'Charging Pool deleted successfully',
            200
        );
    }
}
