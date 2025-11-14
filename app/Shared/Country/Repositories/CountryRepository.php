<?php

declare(strict_types=1);

namespace App\Shared\Country\Repositories;

use App\Shared\Country\Models\Country;
use Illuminate\Database\Eloquent\Collection;

final readonly class CountryRepository
{
    public function __construct(
        private Country $model
    ) {
        //
    }

    /**
     * @return Collection<int, Country>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?Country
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): Country
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(Country|int $country, array $data): ?Country
    {
        if (! ($country instanceof Country)) {
            $country = $this->getById($country);
        }

        if (! is_null($country)) {
            $country->fill($data);
            $country->save();

            return $country;
        }

        return null;
    }

    public function delete(Country|int $country): bool
    {
        if (! ($country instanceof Country)) {
            $country = $this->getById($country);
        }

        if (! is_null($country)) {
            return (bool) $country->delete();
        }

        return false;
    }
}
