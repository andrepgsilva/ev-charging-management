<?php

declare(strict_types=1);

namespace App\Modules\Fleet\Requests\Driver;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateDriverRequest extends FormRequest
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
            'name' => 'nullable|string|min:1|max:255',
            'email' => 'nullable|email|min:5|max:255|unique:companies,email',
            'phone' => 'nullable|string|min:4|max:255',
            'company_id' => 'nullable|int|min:1|exists:companies,id',
        ];
    }
}
