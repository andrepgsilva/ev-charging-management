<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Services;

use Illuminate\Support\Collection;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;
use App\Modules\ChargingInfrastructure\Repositories\ChargingPoolRepository;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPool\CreateChargingPoolDto;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPool\UpdateChargingPoolDto;

final readonly class ChargingPoolService
{
    public function __construct(
        private ChargingPoolRepository $chargingPoolRepository
    ) {
        //
    }

    /**
     * @return Collection<int, ChargingPool>
     */
    public function getAll(): Collection
    {
        return $this->chargingPoolRepository->getAll();
    }

    public function getById(int $id): ?ChargingPool
    {
        return $this->chargingPoolRepository->getById($id);
    }

    public function create(CreateChargingPoolDto $createChargingPoolDto): ChargingPool
    {
        return $this->chargingPoolRepository->create($createChargingPoolDto->toArray());
    }

    public function update(ChargingPool|int $chargingPool, UpdateChargingPoolDto $updateChargingPoolDto): ?ChargingPool
    {
        return $this->chargingPoolRepository->update($chargingPool, $updateChargingPoolDto->toArray());
    }

    public function delete(ChargingPool|int $chargingPool): bool
    {
        return $this->chargingPoolRepository->delete($chargingPool);
    }
}
