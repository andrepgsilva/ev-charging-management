<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\Requests\ChargingPoint;

use Illuminate\Foundation\Http\FormRequest;

final class CreateChargingPointRequest extends FormRequest
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
            'charging_pool_id' => 'nullable|integer',
            'label' => 'string|min:1|max:255',
            'vendor' => 'nullable|string|min:1|max:255',
            'serial_number' => 'nullable|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:255',
        ];
    }
}
