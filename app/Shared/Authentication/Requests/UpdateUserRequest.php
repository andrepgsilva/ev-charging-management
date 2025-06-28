<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Date;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string|array<string|Date>>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|min:1|max:255',
            'email' => 'sometimes|email|min:5|max:255|unique:users,email',
            'password' => 'sometimes|string|min:4|max:15',
            'email_verified_at' => [
                'sometimes',
                Rule::date()->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
