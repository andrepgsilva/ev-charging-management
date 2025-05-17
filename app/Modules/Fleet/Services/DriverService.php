<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Services;

use Illuminate\Support\Collection;
use App\Modules\Fleet\Models\Driver;
use App\Modules\Fleet\Dtos\Driver\CreateDriverDto;
use App\Modules\Fleet\Dtos\Driver\UpdateDriverDto;
use App\Modules\Fleet\Repositories\DriverRepository;

final readonly class DriverService
{
    public function __construct(
        private DriverRepository $driverRepository
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
