<?php

declare(strict_types=1);

namespace App\Http\Requests\Driver;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class CreateDriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|min:5|max:255|unique:drivers,email',
            'phone' => 'nullable|string|min:4|max:255',
            'company_id' => 'nullable|int|min:1',
        ];
    }
}
