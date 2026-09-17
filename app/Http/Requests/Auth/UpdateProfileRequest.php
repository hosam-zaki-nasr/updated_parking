<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
    public function rules(): array
    {
        return [

            "name" => ["bail", "required", "string", "max:255"],

            "phone" => [
                "bail",
                "required",
                "string",
                "max:255",

                Rule::unique('users', 'phone')->ignore(auth()->user()->phone, 'phone')
            ],

            "email" => [
                "bail",
                "nullable",
                "string",
                "email",
                "max:255",

                Rule::unique('users', 'email')->ignore(auth()->user()->email, 'email')
            ],

            "gender" => ["bail", "nullable", "string", "max:255"],

            "birthday" => ["bail", "nullable", "date", "max:255"],

            'file_id' => ['bail', 'nullable', 'string', 'uuid', 'exists:files,id'],

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'phone.required' => trans('general_validate.phone_is_required'),
            'phone.string' => trans('general_validate.phone_must_be_string'),
            'phone.exists' => trans('general_validate.phone_not_exists'),

            'email.required' => trans('general_validate.email_is_required'),
            'email.unique' => trans('general_validate.email_must_be_unique'),

            'gender.string' => trans('general_validate.gender_must_be_string'),
        ];
    }
}
