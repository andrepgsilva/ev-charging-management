<?php

declare(strict_types=1);

namespace App\Modules\Charging\Requests\ChargerEvent;

use Illuminate\Foundation\Http\FormRequest;

final class ChargerEventStartedRequest extends FormRequest
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
            'charging_point_id' => 'required|integer|min:1|exists:charging_points,id',
            'vehicle_id' => 'required|integer|min:1|exists:vehicles,id',
            'driver_id' => 'required|integer|min:1|exists:drivers,id',
            'start_time' => 'required|string|min:10|max:30',
            'end_time' => 'nullable|string|min:10|max:30',
            'energy_kwh' => 'nullable|string|min:1|max:255',
            'cost' => 'nullable|string|min:1|max:255',
            'connector_number' => 'required|integer|min:1',
        ];
    }
}
