<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

final class CompanyRepository
{
    public function __construct(
        private readonly Company $model
    ) {
        //
    }

    /**
     * @return Collection<int, Company>
     */
    public function getAll(): Collection
    {
        return $this->model->newQuery()->latest()->get();
    }

    public function getById(int $id): ?Company
    {
        return $this->model->newQuery()->find($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): Company
    {
        return $this->model->newQuery()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(int $id, array $data): ?Company
    {
        $company = $this->getById($id);

        if (! is_null($company)) {
            $company->fill($data);
            $company->save();

            return $company;
        }

        return null;
    }

    public function delete(int $id): bool
    {
        $company = $this->getById($id);

        if (! is_null($company)) {
            return (bool) $company->delete();
        }

        return false;
    }
}
