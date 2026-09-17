<?php

namespace Customer\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CarUpdateRequest extends FormRequest
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

            "name" => ["bail", "required", "string", "max:255"],

            "number" => [
                "bail",
                "required",
                "numeric",
                "max:9999",

                Rule::unique('cars')
                    ->where('number', $request->number)
                    ->where('text', $request->text)
                    ->ignore($request->car->id, 'id')
                    ->whereNull('deleted_at')
            ],

            "text" => [
                "bail",
                "required",
                "string",
                "max:255",

                Rule::unique('cars')
                    ->where('number', $request->number)
                    ->where('text', $request->text)
                    ->ignore($request->car->id, 'id')
                    ->whereNull('deleted_at')
            ],

            'file_id' => ['bail', 'nullable', 'string', 'uuid', 'exists:files,id'],

            'car_color_id' => ['bail', 'required', 'string', 'uuid', 'exists:car_colors,id'],

            'car_type_id' => ['bail', 'required', 'string', 'uuid', 'exists:car_types,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'number.required' => trans('general_validate.number_is_required'),
            'number.numeric' => trans('general_validate.number_must_be_numeric'),
            'number.unique' => trans('general_validate.number_must_be_unique'),

            'text.required' => trans('general_validate.text_is_required'),
            'text.string' => trans('general_validate.text_must_be_string'),
            'text.unique' => trans('general_validate.text_must_be_unique'),

            'file_id.string' => trans('general_validate.file_id_must_be_string'),
            'file_id.uuid' => trans('general_validate.file_id_must_be_valid_uuid'),
            'file_id.exists' => trans('general_validate.file_id_not_exists'),

            'car_color_id.required' => trans('general_validate.car_color_id_is_required'),
            'car_color_id.string' => trans('general_validate.car_color_id_must_be_string'),
            'car_color_id.uuid' => trans('general_validate.car_color_id_must_be_valid_uuid'),
            'car_color_id.exists' => trans('general_validate.car_color_id_not_exists'),

            'car_type_id.required' => trans('general_validate.car_type_id_is_required'),
            'car_type_id.string' => trans('general_validate.car_type_id_must_be_string'),
            'car_type_id.uuid' => trans('general_validate.car_type_id_must_be_valid_uuid'),
            'car_type_id.exists' => trans('general_validate.car_type_id_not_exists'),

        ];
    }
}
