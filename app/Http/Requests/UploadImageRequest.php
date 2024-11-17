<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,gif|max:5120',
            'item_id' => 'required|exists:items,id',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'An image file is required.',
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'Only JPEG, PNG, and GIF images are allowed.',
            'item_id.required' => 'Item ID is required.',
            'item_id.exists' => 'The provided item ID does not exist.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => 'Forbidden: Invalid input data',
                'messages' => $validator->errors(),
            ], 403)
        );
    }
}
