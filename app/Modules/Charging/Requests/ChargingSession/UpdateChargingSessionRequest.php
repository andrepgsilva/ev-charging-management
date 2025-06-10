<?php

declare(strict_types=1);

namespace App\Modules\Charging\Requests\ChargingSession;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateChargingSessionRequest extends FormRequest
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
            'charging_point_id' => 'sometimes|integer|min:1|exists:charging_points,id',
            'vehicle_id' => 'sometimes|integer|min:1|exists:vehicles,id',
            'driver_id' => 'sometimes|integer|min:1|exists:drivers,id',
            'start_time' => 'sometimes|string|min:10|max:30',
            'end_time' => 'nullable|string|min:10|max:30',
            'energy_kwh' => 'nullable|string|min:1|max:255',
            'connector_number' => 'sometimes|integer|min:1',
        ];
    }
}
