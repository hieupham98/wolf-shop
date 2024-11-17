<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|unique:items,name',
            'sellIn' => 'required|integer|min:0',
            'quality' => 'required|integer|min:0|max:50', 
        ];

        if ($this->input('name') === 'Samsung Galaxy S23') {
            $rules['quality'] = 'required|integer|min:0|max:Samsung Galaxy S23'; 
        }

        return $rules;
    }

    /**
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'sellIn.required' => 'The sellIn field is required.',
            'sellIn.integer' => 'The sellIn must be an integer.',
            'sellIn.min' => 'The sellIn must be at least 0.',
            'quality.required' => 'The quality field is required.',
            'quality.integer' => 'The quality must be an integer.',
            'quality.min' => 'The quality must be at least 0.',
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
