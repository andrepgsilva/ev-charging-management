<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\ChargingInfrastructure\Models\ChargingPoint;

final readonly class ChargingPointRepository
{
    public function __construct(
        private ChargingPoint $model
    ) {
        //
    }

    /**
     * @return Collection<int, ChargingPoint>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?ChargingPoint
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): ChargingPoint
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(ChargingPoint|int $chargingPoint, array $data): ?ChargingPoint
    {
        if (! ($chargingPoint instanceof ChargingPoint)) {
            $chargingPoint = $this->getById($chargingPoint);
        }

        if (! is_null($chargingPoint)) {
            $chargingPoint->fill($data);
            $chargingPoint->save();

            return $chargingPoint;
        }

        return null;
    }

    public function delete(ChargingPoint|int $chargingPoint): bool
    {
        if (! ($chargingPoint instanceof ChargingPoint)) {
            $chargingPoint = $this->getById($chargingPoint);
        }

        if (! is_null($chargingPoint)) {
            return (bool) $chargingPoint->delete();
        }

        return false;
    }
}
