<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|min:5|max:255|unique:users,email',
            'password' => 'required|string|min:4|max:15',
        ];
    }
}
