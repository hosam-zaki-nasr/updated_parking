<?php

namespace Customer\Http\Requests\UserChargeOperation;

use Illuminate\Foundation\Http\FormRequest;

class UserChargeOperationCreateRequest extends FormRequest
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

            "amount" => ["bail", "required", "numeric", "max:1000000"],

            "notes" => ["bail", "nullable", "string", "max:500"],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => trans('general_validate.amount_is_required'),
            'amount.numeric' => trans('general_validate.amount_must_be_numeric'),

            'notes.string' => trans('general_validate.notes_must_be_string'),
        ];
    }
}
