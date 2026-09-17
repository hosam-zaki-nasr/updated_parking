<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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

            "name" => ["required", "string", "max:255"],

            "notification_token" => ["nullable", "string", "max:255"],

            "gender" => ["nullable", "string", "max:255"],

            "birthday" => ["nullable", "date", "max:255"],

            "email" => [
                "nullable",
                "email",
                "unique:users,email",
                "max:255",
                Rule::unique('users', 'email')
                    ->where('deleted_at', null)
            ],

            "phone" => [
                "required",
                "string",
                "max:255",
                Rule::unique('users', 'phone')
                    ->where('deleted_at', null)
            ],

            "password" => ["required", "string", "max:255"]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'email.email' => trans('general_validate.email_must_be_email'),
            'email.unique' => trans('general_validate.email_must_be_unique'),

            'phone.required' => trans('general_validate.phone_is_required'),
            'phone.string' => trans('general_validate.phone_must_be_string'),
            'phone.unique' => trans('general_validate.phone_must_be_unique'),

            'password.required' => trans('general_validate.password_is_required'),
            'password.string' => trans('general_validate.password_must_be_string'),
        ];
    }
}
