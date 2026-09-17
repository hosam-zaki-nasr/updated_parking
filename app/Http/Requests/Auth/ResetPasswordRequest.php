<?php

namespace App\Http\Requests\Auth;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
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

            'phone' => ['bail', 'nullable', 'string', 'exists:users,phone', 'max:100'],

            'password' => ['bail', 'required', 'string', 'max:100'],

            'confirm_password' => ['same:password'],

            'reset_password_code' => [

                'bail',
                'required',
                'string',
                'max:4',
                'min:4',

                Rule::exists('users')->where(function (Builder $query) use ($request) {

                    return $query->where([

                        'reset_password_code' => $request->reset_password_code,
                    ]);
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [

            'phone.required' => trans('general_validate.phone_is_required'),
            'phone.string' => trans('general_validate.phone_must_be_string'),
            'phone.unique' => trans('general_validate.phone_must_be_unique'),

            'password.required' => trans('general_validate.password_is_required'),
            'password.string' => trans('general_validate.password_must_be_string'),

            'confirm_password.same' => trans('general_validate.confirm_password_must_be_same_password'),

            'reset_password_code.required' => trans('general_validate.reset_password_code_is_required'),
            'reset_password_code.string' => trans('general_validate.reset_password_code_must_be_string'),
        ];
    }
}
