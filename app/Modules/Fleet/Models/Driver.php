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
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property int|null $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class Driver extends BaseModel
{
    /** @use HasFactory<DriverFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_id',
    ];

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
