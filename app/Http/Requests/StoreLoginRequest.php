<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'exists:users,username'],
            'password' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }
}
