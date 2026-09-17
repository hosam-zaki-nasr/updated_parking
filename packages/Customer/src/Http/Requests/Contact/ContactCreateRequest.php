<?php

namespace Customer\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
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

            "email" => ["bail", "nullable", "email", "unique:users,email", "max:255"],

            "phone" => ["bail", "required", "string", "unique:users,phone", "max:255"],

            "gender" => ["nullable", "string", "max:255"],

            "birthday" => ["nullable", "date", "max:255"],

            "password" => ["bail", "required", "string", "max:255"],

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

            'gender.string' => trans('general_validate.gender_must_be_string'),

            'birthday.date' => trans('general_validate.birthday_must_be_date'),

            'password.required' => trans('general_validate.password_is_required'),
            'password.string' => trans('general_validate.password_must_be_string'),
        ];
    }
}
