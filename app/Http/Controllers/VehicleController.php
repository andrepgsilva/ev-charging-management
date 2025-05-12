<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Dtos\Vehicle\CreateVehicleDto;
use App\Dtos\Vehicle\UpdateVehicleDto;
use App\Http\Resources\VehicleResource;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;

final class VehicleController
{
    use ApiResponseTrait;

    public function __construct(
        private VehicleService $vehicleService,
    ) {
        //
    }

    public function index(): JsonResponse
    {
        $allVehicles = $this->vehicleService->getAll();

        return $this->successResponse(
            $allVehicles->toResourceCollection(VehicleResource::class),
            'Vehicles retrieved successfully'
        );
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        return $this->successResponse(
            $vehicle->toResource(VehicleResource::class),
            'Vehicle retrieved successfully'
        );
    }

    /**
     * @param  CreateVehicleRequest&Request  $createVehicleRequest
     */
    public function store(CreateVehicleRequest $createVehicleRequest, CreateVehicleDto $createVehicleDto): JsonResponse
    {
        /**
         * @var array{
         *  make: string,
         *  model: string,
         *  plate_number: string,
         *  battery_capacity_kwh?: string,
         *  company_id?: int,
         *  driver_id?: int,
         * }
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
         * }
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
