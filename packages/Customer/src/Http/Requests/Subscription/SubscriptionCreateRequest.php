<?php

namespace Customer\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionCreateRequest extends FormRequest
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

            "garage_id" => ["bail", "required", "string", "uuid", "exists:garages,id"],
        ];
    }

    public function messages(): array
    {
        return [
            'garage_id.required' => trans('general_validate.garage_id_is_required'),
            'garage_id.string' => trans('general_validate.garage_id_must_be_string'),
            'garage_id.uuid' => trans('general_validate.garage_id_must_be_valid_uuid'),
            'garage_id.exists' => trans('general_validate.garage_id_not_exists'),
        ];
    }
}
