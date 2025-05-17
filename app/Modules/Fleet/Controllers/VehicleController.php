<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Modules\Fleet\Models\Vehicle;
use App\Shared\Traits\ApiResponseTrait;
use App\Modules\Fleet\Services\VehicleService;
use App\Modules\Fleet\Resources\VehicleResource;
use App\Modules\Fleet\Dtos\Vehicle\CreateVehicleDto;
use App\Modules\Fleet\Dtos\Vehicle\UpdateVehicleDto;
use App\Modules\Fleet\Requests\Vehicle\CreateVehicleRequest;
use App\Modules\Fleet\Requests\Vehicle\UpdateVehicleRequest;

final class VehicleController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly VehicleService $vehicleService,
    ) {
        //
    }

    /**
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $allVehicles = $this->vehicleService->getAll();

        return $this->successResponse(
            $allVehicles->toResourceCollection(VehicleResource::class),
            'Vehicles retrieved successfully'
        );
    }

    /**
     * @throws Throwable
     */
    public function show(Vehicle $vehicle): JsonResponse
    {
        return $this->successResponse(
            $vehicle->toResource(VehicleResource::class),
            'Vehicle retrieved successfully'
        );
    }

    /**
     * @param  CreateVehicleRequest&Request  $createVehicleRequest
     *
     * @throws Throwable
     */
    public function store(
        CreateVehicleRequest $createVehicleRequest,
        CreateVehicleDto $createVehicleDto
    ): JsonResponse {
        /**
         * @var array{
         *  make: string,
         *  model: string,
         *  plate_number: string,
         *  battery_capacity_kwh?: string,
         *  company_id?: int,
         *  driver_id?: int,
         * } $data
         */
        $data = $createVehicleRequest->all();
        $createVehicleDto->fillFromArray($data);

        $vehicle = $this->vehicleService->create($createVehicleDto);

        return $this->successResponse(
            $vehicle->toResource(VehicleResource::class),
            'Vehicle created successfully',
            201
        );
    }

    /**
     * @param  UpdateVehicleRequest&Request  $updateVehicleRequest
     *
     * @throws Throwable
     */
    public function update(
        Vehicle $vehicle,
        UpdateVehicleRequest $updateVehicleRequest,
        UpdateVehicleDto $updateVehicleDto
    ): JsonResponse {
        /**
         * @var array{
         *  make?: string,
         *  model?: string,
         *  plate_number?: string,
         *  battery_capacity_kwh?: string,
         *  company_id?: int,
         *  driver_id?: int,
         * } $data
         */
        $data = $updateVehicleRequest->all();
        $updateVehicleDto->fillFromArray($data);

        /** @var Vehicle $vehicle */
        $vehicle = $this->vehicleService->update(
            $updateVehicleDto,
            $vehicle,
        );

        return $this->successResponse(
            $vehicle->toResource(VehicleResource::class),
            'Vehicle created successfully',
            201
        );
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        $this->vehicleService->delete($vehicle);

        return $this->successResponse(
            [],
            'Vehicle deleted successfully',
            200
        );
    }
}
