<?php

declare(strict_types=1);

namespace App\Modules\Charging\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Charging\Models\ChargingSession;

final readonly class ChargingSessionRepository
{
    public function __construct(
        private ChargingSession $model
    ) {
        //
    }

    /**
     * @return Collection<int, ChargingSession>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?ChargingSession
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): ChargingSession
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(ChargingSession|int $ChargingSession, array $data): ?ChargingSession
    {
        if (! ($ChargingSession instanceof ChargingSession)) {
            $ChargingSession = $this->getById($ChargingSession);
        }

        if (! is_null($ChargingSession)) {
            $ChargingSession->fill($data);
            $ChargingSession->save();

            return $ChargingSession;
        }

        return null;
    }

    public function delete(ChargingSession|int $ChargingSession): bool
    {
        if (! ($ChargingSession instanceof ChargingSession)) {
            $ChargingSession = $this->getById($ChargingSession);
        }

        if (! is_null($ChargingSession)) {
            return (bool) $ChargingSession->delete();
        }

        return false;
    }
}
