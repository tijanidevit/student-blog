<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'matric_no' => 'required|unique:students',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'A student with this email address already exists',
            'matric_no.unique' => 'A student with this matric number already exists',
        ];
    }
}
