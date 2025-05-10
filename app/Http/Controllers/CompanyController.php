<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Dtos\Company\CreateCompanyDto;
use App\Dtos\Company\UpdateCompanyDto;
use App\Http\Resources\CompanyResource;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;

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

    public function show(string $id): JsonResponse
    {
        $company = $this->companyService->getById((int) $id);

        if (is_null($company)) {
            return $this->errorResponse(
                'Company not found',
                404
            );
        }

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
    public function update(string $id, UpdateCompanyRequest $updateCompanyRequest): JsonResponse
    {

        $updateCompanyDto = app(UpdateCompanyDto::class);

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

        $company = $this->companyService->update(
            (int) $id,
            $updateCompanyDto
        );

        if (is_null($company)) {
            return $this->errorResponse(
                'Company not found',
                404
            );
        }

        return $this->successResponse(
            $company->toResource(CompanyResource::class),
            'Company created successfully',
            201
        );
    }

    public function destroy(string $id): JsonResponse
    {
        $isDeleted = $this->companyService->delete((int) $id);

        if (! $isDeleted) {
            return $this->errorResponse(
                'Company not found',
                404
            );
        }

        return $this->successResponse(
            [],
            'Company deleted successfully',
            200
        );
    }
}
