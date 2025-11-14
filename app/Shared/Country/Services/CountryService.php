<?php

declare(strict_types=1);

namespace App\Shared\Country\Services;

use Illuminate\Support\Collection;
use App\Shared\Country\Models\Country;
use App\Shared\Country\Dtos\CreateCountryDto;
use App\Shared\Country\Dtos\UpdateCountryDto;
use App\Shared\Country\Repositories\CountryRepository;

final readonly class CountryService
{
    public function __construct(
        private CountryRepository $countryRepository
    ) {
        //
    }

    /**
     * @return Collection<int, Country>
     */
    public function getAll(): Collection
    {
        return $this->countryRepository->getAll();
    }

    public function getById(int $id): ?Country
    {
        return $this->countryRepository->getById($id);
    }

    public function create(CreateCountryDto $createCountryDto): Country
    {
        return $this->countryRepository->create($createCountryDto->toArray());
    }

    public function update(Country|int $country, UpdateCountryDto $updateCountryDto): ?Country
    {
        return $this->countryRepository->update($country, $updateCountryDto->toArray());
    }

    public function delete(Country|int $country): bool
    {
        return $this->countryRepository->delete($country);
    }
}
