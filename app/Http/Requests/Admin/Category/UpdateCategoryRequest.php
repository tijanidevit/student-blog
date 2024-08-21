<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'slug' => 'exists:categories',
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->slug, 'slug')
            ]
        ];
    }

    public function prepareForValidation() : void {
        $this->merge([
            'slug' => $this->route('slug')
        ]);
    }
}
