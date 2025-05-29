<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\ChargingInfrastructure\Models\ChargingPool;

final readonly class ChargingPoolRepository
{
    public function __construct(
        private ChargingPool $model
    ) {
        //
    }

    /**
     * @return Collection<int, ChargingPool>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?ChargingPool
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): ChargingPool
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(ChargingPool|int $chargingPool, array $data): ?ChargingPool
    {
        if (! ($chargingPool instanceof ChargingPool)) {
            $chargingPool = $this->getById($chargingPool);
        }

        if (! is_null($chargingPool)) {
            $chargingPool->fill($data);
            $chargingPool->save();

            return $chargingPool;
        }

        return null;
    }

    public function delete(ChargingPool|int $chargingPool): bool
    {
        if (! ($chargingPool instanceof ChargingPool)) {
            $chargingPool = $this->getById($chargingPool);
        }

        if (! is_null($chargingPool)) {
            return (bool) $chargingPool->delete();
        }

        return false;
    }
}
