<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendResetPasswordRequest extends FormRequest
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
            'phone' => ['bail', 'required', 'string', 'exists:users,phone', 'max:100']
        ];
    }

    public function messages(): array
    {
        return [

            'phone.required' => trans('general_validate.phone_is_required'),
            'phone.string' => trans('general_validate.phone_must_be_string'),
            'phone.exists' => trans('general_validate.phone_not_exists'),
        ];
    }
}
