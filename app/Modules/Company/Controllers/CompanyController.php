<?php

declare(strict_types=1);

namespace App\Modules\Company\Controllers;

use App\Modules\Company\Dtos\CreateCompanyDto;
use App\Modules\Company\Dtos\UpdateCompanyDto;
use App\Modules\Company\Models\Company;
use App\Modules\Company\Requests\Company\CreateCompanyRequest;
use App\Modules\Company\Requests\Company\UpdateCompanyRequest;
use App\Modules\Company\Resources\CompanyResource;
use App\Modules\Company\Services\CompanyService;
use App\Shared\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


final class CompanyController
{
    use ApiResponseTrait;

    public function __construct(
        private CompanyService $companyService,
    ) {
        //
    }

    public function index(): JsonResponse
    {
        $allCompanies = $this->companyService->getAll();

        return $this->successResponse(
            $allCompanies->toResourceCollection(CompanyResource::class),
            'Companies retrieved successfully'
        );
    }

    public function show(Company $company): JsonResponse
    {
        return $this->successResponse(
            $company->toResource(CompanyResource::class),
            'Company retrieved successfully'
        );
    }

    /**
     * @param  CreateCompanyRequest&Request  $createCompanyRequest
     */
    public function store(CreateCompanyRequest $createCompanyRequest): JsonResponse
    {
        $createCompanyDto = app(CreateCompanyDto::class);

        /**
         * @var array{
         *  name: string,
         *  email: string,
         *  tax_number: string,
         *  phone?: string,
         *  address?: string,
         * }
         */
        $data = $createCompanyRequest->all();
        $createCompanyDto->fillFromArray($data);

        $company = $this->companyService->create($createCompanyDto);

        return $this->successResponse(
            $company->toResource(CompanyResource::class),
            'Company created successfully',
            201
        );
    }

    /**
     * @param  UpdateCompanyRequest&Request  $updateCompanyRequest
     */
    public function update(
        Company $company,
        UpdateCompanyRequest $updateCompanyRequest,
        UpdateCompanyDto $updateCompanyDto
    ): JsonResponse {
        /**
         * @var array{
         *  name: string,
         *  email: string,
         *  tax_number: string,
         *  phone?: string,
         *  address?: string,
         * }
         */
        $data = $updateCompanyRequest->all();
        $updateCompanyDto->fillFromArray($data);

        /** @var Company */
        $company = $this->companyService->update(
            $company,
            $updateCompanyDto
        );

        return $this->successResponse(
            $company->toResource(CompanyResource::class),
            'Company created successfully',
            201
        );
    }

    public function destroy(Company $company): JsonResponse
    {
        $this->companyService->delete($company);

        return $this->successResponse(
            [],
            'Company deleted successfully',
            200
        );
    }
}
