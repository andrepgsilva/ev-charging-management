<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Collection;
use App\Dtos\Company\CreateCompanyDto;
use App\Dtos\Company\UpdateCompanyDto;
use App\Repositories\CompanyRepository;

final class CompanyService
{
    public function __construct(
        private readonly CompanyRepository $companyRepository
    ) {
        //
    }

    /**
     * @return Collection<int, Company>
     */
    public function getAll(): Collection
    {
        return $this->companyRepository->getAll();
    }

    public function getById(int $id): ?Company
    {
        return $this->companyRepository->getById($id);
    }

    public function create(CreateCompanyDto $createCompanyDto): Company
    {
        return $this->companyRepository->create($createCompanyDto->toArray());
    }

    public function update(int $id, UpdateCompanyDto $updateCompanyDto): ?Company
    {
        return $this->companyRepository->update($id, $updateCompanyDto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->companyRepository->delete($id);
    }
}
