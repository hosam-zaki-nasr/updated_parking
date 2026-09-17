<?php

namespace Driver\Http\Requests\ParkingFile;

use Illuminate\Foundation\Http\FormRequest;

class ParkingFileCreateRequest extends FormRequest
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

            "parking_id" => ["bail", "required", 'uuid', 'exists:parkings,id'],

            'files' => ['required', 'array'],

            'files.*' => ['required', 'file'],
        ];
    }

    public function messages(): array
    {
        return [

            'parking_id.required' => trans('general_validate.parking_id_is_required'),
            'parking_id.string' => trans('general_validate.parking_id_must_be_string'),
            'parking_id.uuid' => trans('general_validate.parking_id_must_be_valid_uuid'),
            'parking_id.exists' => trans('general_validate.parking_id_not_exists'),

        ];
    }
}
