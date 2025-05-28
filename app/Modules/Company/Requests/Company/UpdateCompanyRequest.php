<?php

declare(strict_types=1);

namespace App\Modules\Company\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateCompanyRequest extends FormRequest
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
            'name' => 'nullable|string|min:1|max:255',
            'email' => 'nullable|email|min:5|max:255|unique:companies,email',
            'tax_number' => 'nullable|string|min:9|max:255|unique:companies,tax_number',
            'phone' => 'nullable|string|min:4|max:255',
            'address' => 'nullable|string|min:3|max:255',
        ];
    }
}
