<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Services;

use Illuminate\Support\Collection;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;
use App\Modules\ChargingInfrastructure\Repositories\ChargingPointRepository;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPoint\CreateChargingPointDto;
use App\Modules\ChargingInfrastructure\Dtos\ChargingPoint\UpdateChargingPointDto;

final readonly class ChargingPointService
{
    public function __construct(
        private ChargingPointRepository $chargingPointRepository
    ) {
        //
    }

    /**
     * @return Collection<int, ChargingPoint>
     */
    public function getAll(): Collection
    {
        return $this->chargingPointRepository->getAll();
    }

    public function getById(int $id): ?ChargingPoint
    {
        return $this->chargingPointRepository->getById($id);
    }

    public function create(CreateChargingPointDto $createChargingPointDto): ChargingPoint
    {
        return $this->chargingPointRepository->create($createChargingPointDto->toArray());
    }

    public function update(
        ChargingPoint|int $chargingPoint,
        UpdateChargingPointDto $updateChargingPointDto
    ): ?ChargingPoint {
        return $this->chargingPointRepository->update($chargingPoint, $updateChargingPointDto->toArray());
    }

    public function delete(ChargingPoint|int $chargingPoint): bool
    {
        return $this->chargingPointRepository->delete($chargingPoint);
    }
}
