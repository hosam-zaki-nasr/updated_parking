<?php

namespace Driver\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParkingConfirmRequest extends FormRequest
{
    /**
     * Determine if the company is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            "longitude" => ["bail", "required", "numeric", "max:100000"],

            "latitude" => ["bail", "required", "numeric", "max:100000"],
        ];
    }

    public function messages(): array
    {
        return [

            'longitude.required' => trans('general_validate.longitude_is_required'),
            'longitude.numeric' => trans('general_validate.longitude_must_be_numeric'),

            'latitude.required' => trans('general_validate.latitude_is_required'),
            'latitude.numeric' => trans('general_validate.latitude_must_be_numeric'),
        ];
    }
}
