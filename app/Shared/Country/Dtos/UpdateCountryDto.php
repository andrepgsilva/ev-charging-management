<?php

declare(strict_types=1);

namespace App\Shared\Country\Dtos;

use App\Shared\Traits\DtoTrait;

final class CreateCountryDto
{
    use DtoTrait;

    /**
     *  @use DtoTrait<array{
     *       string name,
     *       string iso,
     *       string imageUrl
     *  }>
     */

    public string $name;

    public string $iso;

    public string $imageUrl;
}
