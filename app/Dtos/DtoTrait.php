<?php

declare(strict_types=1);

namespace App\Dtos;

trait DtoTrait
{
    /**
     * Convert the DTO to an array.
     *
     * @return array<string, mixed>
     */
    public function convertToArray(): array
    {
        return get_object_vars($this);
    }
}
