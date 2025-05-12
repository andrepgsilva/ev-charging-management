<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Services\DriverService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Dtos\Driver\CreateDriverDto;
use App\Dtos\Driver\UpdateDriverDto;
use App\Http\Resources\DriverResource;
use App\Http\Requests\Driver\CreateDriverRequest;
use App\Http\Requests\Driver\UpdateDriverRequest;

final class DriverController
{
    use ApiResponseTrait;

    public function __construct(
        private DriverService $driverService,
    ) {
        //
    }

    public function index(): JsonResponse
    {
        $allDrivers = $this->driverService->getAll();

        return $this->successResponse(
            $allDrivers->toResourceCollection(DriverResource::class),
            'Drivers retrieved successfully'
        );
    }

    public function show(Driver $driver): JsonResponse
    {
        return $this->successResponse(
            $driver->toResource(DriverResource::class),
            'Driver retrieved successfully'
        );
    }

    /**
     * @param  CreateDriverRequest&Request  $createDriverRequest
     */
    public function store(CreateDriverRequest $createDriverRequest): JsonResponse
    {
        $createDriverDto = app(CreateDriverDto::class);

        /**
         * @var array{
         *  name: string,
         *  email: string,
         *  tax_number: string,
         *  phone?: string,
         *  address?: string,
         * }
         */
        $data = $createDriverRequest->all();
        $createDriverDto->fillFromArray($data);

        $driver = $this->driverService->create($createDriverDto);

        return $this->successResponse(
            $driver->toResource(DriverResource::class),
            'Driver created successfully',
            201
        );
    }

    /**
     * @param  UpdateDriverRequest&Request  $updateDriverRequest
     */
    public function update(
        Driver $driver,
        UpdateDriverRequest $updateDriverRequest,
        UpdateDriverDto $updateDriverDto
    ): JsonResponse {
        /**
         * @var array{
         *  name: string,
         *  email: string,
         *  tax_number: string,
         *  phone?: string,
         *  address?: string,
         * }
         */
        $data = $updateDriverRequest->all();
        $updateDriverDto->fillFromArray($data);

        /** @var Driver $driver */
        $driver = $this->driverService->update(
            $driver,
            $updateDriverDto
        );

        return $this->successResponse(
            $driver->toResource(DriverResource::class),
            'Driver created successfully',
            201
        );
    }

    public function destroy(Driver $driver): JsonResponse
    {
        $this->driverService->delete($driver);

        return $this->successResponse(
            [],
            'Driver deleted successfully',
            200
        );
    }
}
