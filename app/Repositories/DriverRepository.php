<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;

final class DriverRepository
{
    public function __construct(
        private readonly Driver $model
    ) {
        //
    }

    /**
     * @return Collection<int, Driver>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?Driver
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): Driver
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(int $id, array $data): ?Driver
    {
        $driver = $this->getById($id);

        if (! is_null($driver)) {
            $driver->fill($data);
            $driver->save();

            return $driver;
        }

        return null;
    }

    public function delete(int $id): bool
    {
        $driver = $this->getById($id);

        if (! is_null($driver)) {
            return (bool) $driver->delete();
        }

        return false;
    }
}
