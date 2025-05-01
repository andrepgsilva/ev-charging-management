<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Vehicle;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $tax_number
 * @property string|null $phone
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
final class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'tax_number',
        'phone',
        'address',
    ];

    public function drivers(): ?HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function vehicles(): ?HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
