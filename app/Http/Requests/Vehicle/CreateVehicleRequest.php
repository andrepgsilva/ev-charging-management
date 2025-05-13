<?php

declare(strict_types=1);

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class CreateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'make' => 'required|string|min:1|max:255',
            'model' => 'required|string|min:5|max:255',
            'plate_number' => 'required|string|min:4|max:255|unique:vehicles,plate_number',
            'battery_capacity_kwh' => 'nullable|string|min:1|max:255',
            'company_id' => 'nullable|int|min:1|exists:companies,id',
            'driver_id' => 'nullable|int|min:1|exists:drivers,id',
        ];
    }
}
