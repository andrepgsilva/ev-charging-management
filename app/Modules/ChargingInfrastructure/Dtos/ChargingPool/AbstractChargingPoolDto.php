<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Dtos\ChargingPool;

use App\Shared\Traits\DtoTrait;

abstract class AbstractChargingPoolDto
{
    /**
     * @use DtoTrait<array{
     *  name: string,
     *  address: string,
     *  country: string,
     *  state: string,
     *  city: string,
     *  postal_code: string,
     *  latitude?: string,
     *  longitude?: string,
     *  type?: string,
     *  description?: string,
     *  company_id?: string,
     * }>
     */
    use DtoTrait;

    /**
     * @return array{
     *  name?: string,
     *  address?: string,
     *  country?: string,
     *  state?: string,
     *  city?: string,
     *  postal_code?: string,
     *  latitude?: string,
     *  longitude?: string,
     *  type?: string,
     *  description?: string,
     *  company_id?: string,
     * }
     */
    final public function toArray(): array
    {
        return $this->convertToArray(true);
    }

    /**
     * @param  array{
     *  name?: string,
     *  address?: string,
     *  country?: string,
     *  state?: string,
     *  city?: string,
     *  postal_code?: string,
     *  latitude?: string,
     *  longitude?: string,
     *  type?: string,
     *  description?: string,
     *  company_id?: string,
     * } $data
     */
    final public function fillFromArray(array $data): void
    {
        $this->fill($data, true);
    }
}
