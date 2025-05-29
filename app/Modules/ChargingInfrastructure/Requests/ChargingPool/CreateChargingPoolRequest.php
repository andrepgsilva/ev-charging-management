<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Requests\ChargingPool;

use Illuminate\Foundation\Http\FormRequest;

final class CreateChargingPoolRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'address' => 'required|string|min:1|max:255',
            'country' => 'required|string|min:1|max:255',
            'state' => 'required|string|min:1|max:255',
            'city' => 'required|string|min:1|max:255',
            'postal_code' => 'required|string|min:1|max:255',
            'latitude' => 'nullable|string|min:1|max:255',
            'longitude' => 'nullable|string|min:1|max:255',
            'type' => 'nullable|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:255',
            'company_id' => 'nullable|int',
        ];
    }
}
