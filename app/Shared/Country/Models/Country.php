<?php

declare(strict_types=1);

namespace App\Shared\Country\Models;

use Carbon\Carbon;
use App\Models\BaseModel;
use App\Shared\Country\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $iso
 * @property-read ?string $image_url
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
final class Country extends BaseModel
{
    /** @use HasFactory<CountryFactory> */
    use HasFactory;

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
