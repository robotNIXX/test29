<?php

namespace App\Http\Requests\Api\Cars;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'model_id' => [
                'required',
                'integer',
                'exists:car_models,id',
            ],
            'brand_id' => [
                'required',
                'integer',
                'exists:car_brands,id',
            ],
            'color' => [
                'sometimes',
                'string',
            ],
            'year' => [
                'sometimes',
                'string',
                'regex:/^(19|20)([0-9]{2})$/',
            ],
            'mileage' => [
                'sometimes',
                'integer',
            ]
        ];
    }
}
