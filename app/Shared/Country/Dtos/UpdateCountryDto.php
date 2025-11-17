<?php

declare(strict_types=1);

namespace App\Shared\Country\Dtos;

use App\Shared\Traits\DtoTrait;

final class UpdateCountryDto
{
    /**
     *  @use DtoTrait<array{
     *       name?: string,
     *       iso?: string,
     *       imageUrl?: string
     *  }>
     */
    use DtoTrait;

    public ?string $name;

    public ?string $iso;

    public ?string $imageUrl;
}
