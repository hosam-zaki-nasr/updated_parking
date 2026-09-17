<?php

namespace Dashboard\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
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

            "name" => ["required", "string", "max:255"],

            "phone" => [
                "required",
                "string",
                "max:255",

                Rule::unique('users', 'phone')->ignore($request->user->id, 'id')
            ],

            "email" => [
                "required",
                "string",
                "max:255",

                Rule::unique('users', 'email')->ignore($request->user->id, 'id')
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

            'password.string' => trans('general_validate.password_must_be_string'),

            'address.string' => trans('general_validate.address_must_be_string'),
        ];
    }
}
