<?php

namespace Dashboard\Http\Requests\Constants\CarColor;

use Illuminate\Foundation\Http\FormRequest;

class CarColorUpdateRequest extends FormRequest
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

            "name" => ["bail", "required", "string", "max:255"],

            "code" => ["bail", "required", "string", "max:255"],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'code.required' => trans('general_validate.code_is_required'),
            'code.string' => trans('general_validate.code_must_be_string'),
        ];
    }
}
