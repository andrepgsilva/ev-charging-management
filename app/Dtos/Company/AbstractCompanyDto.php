<?php

declare(strict_types=1);

namespace App\Dtos\Company;

use App\Dtos\DtoTrait;

abstract class AbstractCompanyDto
{
    use DtoTrait;

    public function __construct(
        public string $name,
        public string $email,
        public string $tax_number,
        public ?string $phone = null,
        public ?string $address = null
    ) {
        //
    }

    /**
     * @return array{
     *  name: string,
     *  email: string,
     *  tax_number: string,
     *  phone: string|null,
     *  address: string|null
     * }
     */
    final public function toArray(): array
    {
        /** @var array{
         *  name: string,
         *  email: string,
         *  tax_number: string,
         *  phone: string|null,
         *  address: string|null
         * }
         */
        return $this->convertToArray();
    }
}
