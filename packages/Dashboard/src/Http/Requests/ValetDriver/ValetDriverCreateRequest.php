<?php

namespace Dashboard\Http\Requests\ValetDriver;

use App\Foundations\LookupType\GarageTypeCollection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValetDriverCreateRequest extends FormRequest
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

            "name" => ["bail", "required", "string", "max:255"],

            "email" => ["bail", "nullable", "email", "unique:users,email", "max:255"],

            "phone" => ["bail", "required", "string", "unique:users,phone", "max:255"],

            "garage_id" => [

                "bail", "required", "uuid",

                Rule::exists('garages', 'id')

                    ->where('type_id', GarageTypeCollection::valet()->id)
            ],

            "password" => ["bail", "required", "string", "max:255"],

            "address" => ["bail", "nullable", "string", "max:255"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'email.required' => trans('general_validate.email_is_required'),
            'email.email' => trans('general_validate.email_must_be_email'),
            'email.unique' => trans('general_validate.email_must_be_unique'),

            'phone.required' => trans('general_validate.phone_is_required'),
            'phone.string' => trans('general_validate.phone_must_be_string'),
            'phone.unique' => trans('general_validate.phone_must_be_unique'),

            'garage_id.required' => trans('general_validate.garage_id_is_required'),
            'garage_id.uuid' => trans('general_validate.garage_id_must_be_valid_uuid'),
            'garage_id.exists' => trans('general_validate.garage_id_not_exists'),

            'password.required' => trans('general_validate.password_is_required'),
            'password.string' => trans('general_validate.password_must_be_string'),

            'address.string' => trans('general_validate.address_must_be_string'),
        ];
    }
}
