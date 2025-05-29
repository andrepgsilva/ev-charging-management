<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Models;

use Carbon\Carbon;
use App\Models\BaseModel;
use App\Modules\Company\Models\Company;
use App\Modules\Fleet\Factories\DriverFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string|null $phone
 * @property-read int|null $company_id
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 */
final class Driver extends BaseModel
{
    /** @use HasFactory<DriverFactory> */
    use HasFactory;

    /** @return BelongsTo<Company, $this> */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected static function newFactory(): DriverFactory
    {
        return DriverFactory::new();
    }
}
