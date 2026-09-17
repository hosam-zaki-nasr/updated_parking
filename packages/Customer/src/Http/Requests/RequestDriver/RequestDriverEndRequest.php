<?php

namespace Customer\Http\Requests\RequestDriver;

use Illuminate\Foundation\Http\FormRequest;

class RequestDriverEndRequest extends FormRequest
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

            "parking_id" => ["required", "uuid", "string", "exists:parkings,id"],

            "garage_id" => ["required", "uuid", "string", "exists:garages,id"],

            "longitude" => ["bail", "nullable", "numeric", "max:100000"],

            "latitude" => ["bail", "nullable", "numeric", "max:100000"],
        ];
    }

    public function messages(): array
    {
        return [

            'parking_id.required' => trans('general_validate.parking_id_is_required'),
            'parking_id.string' => trans('general_validate.parking_id_must_be_string'),
            'parking_id.uuid' => trans('general_validate.parking_id_must_be_valid_uuid'),
            'parking_id.exists' => trans('general_validate.parking_id_not_exists'),

            'garage_id.required' => trans('general_validate.garage_id_is_required'),
            'garage_id.string' => trans('general_validate.garage_id_must_be_string'),
            'garage_id.uuid' => trans('general_validate.garage_id_must_be_valid_uuid'),
            'garage_id.exists' => trans('general_validate.garage_id_not_exists'),

            'longitude.numeric' => trans('general_validate.longitude_must_be_numeric'),
            'latitude.numeric' => trans('general_validate.latitude_must_be_numeric'),
        ];
    }
}
