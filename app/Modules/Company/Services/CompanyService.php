<?php

declare(strict_types=1);

namespace App\Modules\Company\Services;

use App\Modules\Company\Dtos\CreateCompanyDto;
use App\Modules\Company\Dtos\UpdateCompanyDto;
use App\Modules\Company\Models\Company;
use App\Modules\Company\Repositories\CompanyRepository;
use Illuminate\Support\Collection;

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

    public function update(Company|int $company, UpdateCompanyDto $updateCompanyDto): ?Company
    {
        return $this->companyRepository->update($company, $updateCompanyDto->toArray());
    }

    public function delete(Company|int $company): bool
    {
        return $this->companyRepository->delete($company);
    }
}
