<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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
            'name' => [
                Rule::requiredIf(!auth()->user()->isAdmin()),
                'min:3',
            ],
            'about' => 'required|string',
            'image' => [
                Rule::requiredIf(auth()->user()->image == null && !auth()->user()->isAdmin()),
                'file',
                'mimes:png,jpg',
            ],
        ];
    }
}
