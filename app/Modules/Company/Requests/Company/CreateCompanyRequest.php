<?php

declare(strict_types=1);

namespace App\Modules\Company\Requests\Company;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class CreateCompanyRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|min:5|max:255|unique:companies,email',
            'tax_number' => 'required|string|min:9|max:255|unique:companies,tax_number',
            'phone' => 'required|string|min:4|max:255',
            'address' => 'required|string|min:3|max:255',
        ];
    }
}
