<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoR extends FormRequest
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
            'title' => 'required|string',
            'desc' => 'required|string',
            'due_date' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'desc.required' => 'Description is required',
            'due_date.required' => 'Due Date is required',
        ];
    }
}
