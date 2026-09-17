<?php

namespace App\Http\Requests\Auth;

use App\Rules\ValidateUserExists;
use App\Rules\ValidateUserPassword;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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

            "user" => ["required", "string", "max:255", new ValidateUserExists()],
            "password" => ["required", "string", "max:255", new ValidateUserPassword()],
            "notification_token" => ["nullable", "string", "max:255"],
        ];
    }

    public function messages(): array
    {
        return [
            'user.required' => trans('general_validate.user_is_required'),
            'user.string' => trans('general_validate.user_must_be_string'),

            'password.required' => trans('general_validate.password_is_required'),
            'password.string' => trans('general_validate.password_must_be_string'),
        ];
    }
}
