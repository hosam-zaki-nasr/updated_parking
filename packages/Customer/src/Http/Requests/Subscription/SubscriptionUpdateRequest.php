<?php

namespace Customer\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUpdateRequest extends FormRequest
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

            "auto_renew" => ["bail", "required", "boolean"],
        ];
    }

    public function messages(): array
    {
        return [
            'auto_renew.required' => trans('general_validate.auto_renew_is_required'),
            'auto_renew.boolean' => trans('general_validate.auto_renew_must_be_boolean')
        ];
    }
}
