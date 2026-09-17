<?php

namespace Dashboard\Http\Requests\Constants\ChargePrice;

use Illuminate\Foundation\Http\FormRequest;

class ChargePriceUpdateRequest extends FormRequest
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

            "price" => ["bail", "required", "numeric", "max:100000000"],
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => trans('general_validate.price_is_required'),
            'price.numeric' => trans('general_validate.price_must_be_numeric'),
        ];
    }
}
