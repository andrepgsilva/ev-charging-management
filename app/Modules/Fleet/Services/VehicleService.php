<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Services;

use App\Modules\Fleet\Dtos\Vehicle\CreateVehicleDto;
use App\Modules\Fleet\Dtos\Vehicle\UpdateVehicleDto;
use App\Modules\Fleet\Models\Vehicle;
use App\Modules\Fleet\Repositories\VehicleRepository;
use Illuminate\Support\Collection;

final readonly class VehicleService
{
    public function __construct(
        private VehicleRepository $vehicleRepository
    ) {
        //
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getAll(): Collection
    {
        return $this->vehicleRepository->getAll();
    }

    public function getById(int $id): ?Vehicle
    {
        return $this->vehicleRepository->getById($id);
    }

    public function create(CreateVehicleDto $createVehicleDto): Vehicle
    {
        return $this->vehicleRepository->create($createVehicleDto->toArray());
    }

    public function update(
        UpdateVehicleDto $updateVehicleDto,
        Vehicle|int $vehicle
    ): ?Vehicle {
        return $this->vehicleRepository->update($updateVehicleDto->toArray(), $vehicle);
    }

    public function delete(Vehicle|int $vehicle): bool
    {
        return $this->vehicleRepository->delete($vehicle);
    }
}
