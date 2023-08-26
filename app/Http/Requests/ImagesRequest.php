<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg',
            'folder_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'images.required' => 'Images are required.',
            'images.array' => 'Images must be an array.',
            'images.*.image' => 'Each item in images must be a valid image.',
            'images.*.mimes' => 'Each image must be a JPEG, PNG, or JPG file.',
            'folder_name.required' => 'Folder name is required.',
        ];
    }
}
