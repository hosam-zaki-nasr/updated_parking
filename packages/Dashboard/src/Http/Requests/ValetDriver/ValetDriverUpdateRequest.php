<?php

namespace Dashboard\Http\Requests\ValetDriver;

use App\Foundations\LookupType\GarageTypeCollection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ValetDriverUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
        return [

            "name" => ["nullable", "string", "max:255"],

            "phone" => [
                "nullable", "string", "max:255",

                Rule::unique('users', 'phone')->ignore($request->user->id, 'id')
            ],

            "email" => [
                "nullable", "string", "max:255",

                Rule::unique('users', 'email')->ignore($request->user->id, 'id')
            ],

            "garage_id" => [

                "bail", "nullable", "uuid",

                Rule::exists('garages', 'id')

                    ->where('type_id', GarageTypeCollection::valet()->id)
            ],

            "password" => ["nullable", "string", "max:255"],

            "address" => ["nullable", "string", "max:255"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => trans('general_validate.name_must_be_string'),

            'email.email' => trans('general_validate.email_must_be_email'),
            'email.unique' => trans('general_validate.email_must_be_unique'),

            'phone.string' => trans('general_validate.phone_must_be_string'),
            'phone.unique' => trans('general_validate.phone_must_be_unique'),

            'garage_id.uuid' => trans('general_validate.garage_id_must_be_valid_uuid'),
            'garage_id.exists' => trans('general_validate.garage_id_not_exists'),

            'password.required' => trans('general_validate.password_is_required'),
            'password.string' => trans('general_validate.password_must_be_string'),

            'address.string' => trans('general_validate.address_must_be_string'),
        ];
    }
}
