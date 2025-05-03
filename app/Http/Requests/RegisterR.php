<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterR extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:4',
                'string',
                // 'regex:/[a-z]/',
                // 'regex:/[@$!%*#?&]/',
                // 'regex:/[A-Z]/'
            ]
        ];
    }
    public function messages()
    {
        return [
            'password.min' => 'The password must be at least 8 characters long.',
            // 'password.regex' => 'The password must include both uppercase and lowercase letters, and symbols.',

        ];
    }
}
