<?php

namespace Driver\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParkingEndRequest extends FormRequest
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

            "user_id" => ["bail", "required", 'uuid', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [

            'user_id.required' => trans('general_validate.user_id_is_required'),
            'user_id.string' => trans('general_validate.user_id_must_be_string'),
            'user_id.uuid' => trans('general_validate.user_id_must_be_valid_uuid'),
            'user_id.exists' => trans('general_validate.user_id_not_exists'),

        ];
    }
}
