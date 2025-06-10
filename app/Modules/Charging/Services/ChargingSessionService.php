<?php

declare(strict_types=1);

namespace App\Modules\Charging\Services;

use Illuminate\Support\Collection;
use App\Modules\Charging\Models\ChargingSession;
use App\Modules\Charging\Repositories\ChargingSessionRepository;
use App\Modules\Charging\Dtos\ChargingSession\CreateChargingSessionDto;
use App\Modules\Charging\Dtos\ChargingSession\UpdateChargingSessionDto;

final readonly class ChargingSessionService
{
    public function __construct(
        private ChargingSessionRepository $ChargingSessionRepository
    ) {
        //
    }

    /**
     * @return Collection<int, ChargingSession>
     */
    public function getAll(): Collection
    {
        return $this->ChargingSessionRepository->getAll();
    }

    public function getById(int $id): ?ChargingSession
    {
        return $this->ChargingSessionRepository->getById($id);
    }

    public function create(CreateChargingSessionDto $createChargingSessionDto): ChargingSession
    {
        return $this->ChargingSessionRepository->create($createChargingSessionDto->toArray());
    }

    public function update(ChargingSession|int $ChargingSession, UpdateChargingSessionDto $updateChargingSessionDto): ?ChargingSession
    {
        return $this->ChargingSessionRepository->update($ChargingSession, $updateChargingSessionDto->toArray());
    }

    public function delete(ChargingSession|int $ChargingSession): bool
    {
        return $this->ChargingSessionRepository->delete($ChargingSession);
    }
}
