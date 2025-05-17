<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateVehicleRequest extends FormRequest
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
            'make' => 'nullable|string|min:1|max:255',
            'model' => 'nullable|string|min:5|max:255',
            'plate_number' => 'nullable|string|min:4|max:255|unique:vehicles,plate_number',
            'battery_capacity_kwh' => 'nullable|string|min:1|max:255',
            'company_id' => 'nullable|int|min:1|exists:companies,id',
            'driver_id' => 'nullable|int|min:1|exists:companies,id',
        ];
    }
}
