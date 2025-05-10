<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:1|max:255',
            'email' => 'nullable|email|min:5|max:255',
            'tax_number' => 'nullable|string|min:9|max:255',
            'phone' => 'nullable|string|min:4|max:255',
            'address' => 'nullable|string|min:3|max:255',
        ];
    }
}
