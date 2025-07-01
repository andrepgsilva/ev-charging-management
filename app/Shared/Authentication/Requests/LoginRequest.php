<?php

declare(strict_types=1);

namespace App\Shared\Authentication\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
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
            'email' => 'required|email|min:5|max:255',
            'password' => 'required|min:4|max:15',
        ];
    }
}
