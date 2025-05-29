<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Requests\ChargingPool;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateChargingPoolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:1|max:255',
            'address' => 'nullable|string|min:1|max:255',
            'country' => 'nullable|string|min:1|max:255',
            'state' => 'nullable|string|min:1|max:255',
            'city' => 'nullable|string|min:1|max:255',
            'postal_code' => 'nullable|string|min:1|max:255',
            'latitude' => 'nullable|string|min:1|max:255',
            'longitude' => 'nullable|string|min:1|max:255',
            'type' => 'nullable|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:255',
            'company_id' => 'nullable|int',
        ];
    }
}
