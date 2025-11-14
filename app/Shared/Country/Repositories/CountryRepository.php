<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Repositories;

use App\Modules\Fleet\Models\Driver;
use Illuminate\Database\Eloquent\Collection;

final readonly class DriverRepository
{
    public function __construct(
        private Driver $model
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
    public function update(Driver|int $driver, array $data): ?Driver
    {
        if (! ($driver instanceof Driver)) {
            $driver = $this->getById($driver);
        }

        if (! is_null($driver)) {
            $driver->fill($data);
            $driver->save();

            return $driver;
        }

        return null;
    }

    public function delete(Driver|int $driver): bool
    {
        if (! ($driver instanceof Driver)) {
            $driver = $this->getById($driver);
        }

        if (! is_null($driver)) {
            return (bool) $driver->delete();
        }

        return false;
    }
}
