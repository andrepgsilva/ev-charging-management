<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Driver;
use Illuminate\Support\Collection;
use App\Dtos\Driver\CreateDriverDto;
use App\Dtos\Driver\UpdateDriverDto;
use App\Repositories\DriverRepository;

final class DriverService
{
    public function __construct(
        private readonly DriverRepository $driverRepository
    ) {
        //
    }

    /**
     * @return Collection<int, Driver>
     */
    public function getAll(): Collection
    {
        return $this->driverRepository->getAll();
    }

    public function getById(int $id): ?Driver
    {
        return $this->driverRepository->getById($id);
    }

    public function create(CreateDriverDto $createDriverDto): Driver
    {
        return $this->driverRepository->create($createDriverDto->toArray());
    }

    public function update(Driver|int $driver, UpdateDriverDto $updateDriverDto): ?Driver
    {
        return $this->driverRepository->update($driver, $updateDriverDto->toArray());
    }

    public function delete(Driver|int $driver): bool
    {
        return $this->driverRepository->delete($driver);
    }
}
