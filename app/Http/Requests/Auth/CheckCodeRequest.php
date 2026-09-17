<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CheckCodeRequest extends FormRequest
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

            'reset_password_code' => ['bail', 'required', 'string', 'exists:users,reset_password_code', 'max:4'],

        ];
    }

    public function messages(): array
    {
        return [
            'reset_password_code.required' => trans('general_validate.reset_password_code_is_required'),

            'reset_password_code.string' => trans('general_validate.reset_password_code_must_be_string'),

            'reset_password_code.exists' => trans('general_validate.reset_password_code_not_exists'),
        ];
    }
}
