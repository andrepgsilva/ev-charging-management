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
            'event' => 'required|string',
            'session_id' => 'required|integer|min:1',
            'meter_kwh' => 'nullable|string|min:1|max:255',
            'timestamp' => 'required|string|min:10|max:30',
        ];
    }
}
