<?php

namespace App\Http\Requests\Admin\TopCategory;

use Illuminate\Foundation\Http\FormRequest;

class AddTopCategoryRequest extends FormRequest
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
            'categories' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'categories.required' => 'Please select at least one category',
            'categories.array' => 'Please select at least one category',
        ];
    }
}
