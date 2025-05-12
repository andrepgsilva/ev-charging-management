<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

final class VehicleRepository
{
    public function __construct(
        private readonly Vehicle $model
    ) {
        //
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?Vehicle
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): Vehicle
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(array $data, Vehicle|int $vehicle): ?Vehicle
    {
        if (! ($vehicle instanceof Vehicle)) {
            $vehicle = $this->getById($vehicle);
        }

        if (! is_null($vehicle)) {
            $vehicle->fill($data);
            $vehicle->save();

            return $vehicle;
        }

        return null;
    }

    public function delete(Vehicle|int $vehicle): bool
    {
        if (! ($vehicle instanceof Vehicle)) {
            $vehicle = $this->getById($vehicle);
        }

        if (! is_null($vehicle)) {
            return (bool) $vehicle->delete();
        }

        return false;
    }
}
