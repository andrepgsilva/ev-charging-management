<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Modules\Fleet\Models\Driver;
use App\Shared\Traits\ApiResponseTrait;
use App\Modules\Fleet\Services\DriverService;
use App\Modules\Fleet\Resources\DriverResource;
use App\Modules\Fleet\Dtos\Driver\CreateDriverDto;
use App\Modules\Fleet\Dtos\Driver\UpdateDriverDto;
use App\Modules\Fleet\Requests\Driver\CreateDriverRequest;
use App\Modules\Fleet\Requests\Driver\UpdateDriverRequest;

final class DriverController
{
    use ApiResponseTrait;

    public function __construct(
        private readonly DriverService $driverService,
    ) {
        //
    }

    /**
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $allDrivers = $this->driverService->getAll();

        return $this->successResponse(
            $allDrivers->toResourceCollection(DriverResource::class),
            'Drivers retrieved successfully'
        );
    }

    /**
     * @throws Throwable
     */
    public function show(Driver $driver): JsonResponse
    {
        return $this->successResponse(
            $driver->toResource(DriverResource::class),
            'Driver retrieved successfully'
        );
    }

    /**
     * @param  CreateDriverRequest&Request  $createDriverRequest
     *
     * @throws Throwable
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
         * } $data
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
     *
     * @throws Throwable
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
         * } $data
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
