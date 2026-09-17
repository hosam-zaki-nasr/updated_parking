<?php

namespace Dashboard\Http\Requests\Advertisement;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementUpdateRequest extends FormRequest
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

            "title" => ["bail", "required", "string", "max:255"],

            "details" => ["bail", "required", "string", "max:1000"],

            "amount" => ["bail", "required", "numeric", "max:100000000"],

            "link" => ["bail", "required", "string", "max:1000"],

            'file_id' => ['bail', 'required', 'string', 'uuid', 'exists:files,id'],

            "client_name" => ["bail", "required", "string", "max:255"],

            "client_phone" => ["bail", "required", "string", "max:20"],

            "client_field" => ["bail", "required", "string", "max:255"],

            "starts_at" => ["bail", "required", "string", "max:255"],

            "ends_at" => ["bail", "required", "string", "max:255"],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => trans('general_validate.title_is_required'),
            'title.string' => trans('general_validate.title_must_be_string'),

            'details.required' => trans('general_validate.details_is_required'),
            'details.string' => trans('general_validate.details_must_be_string'),

            'amount.required' => trans('general_validate.amount_is_required'),
            'amount.string' => trans('general_validate.amount_must_be_numeric'),

            'link.required' => trans('general_validate.link_is_required'),
            'link.string' => trans('general_validate.link_must_be_string'),

            'file_id.required' => trans('general_validate.file_id_is_required'),
            'file_id.string' => trans('general_validate.file_id_must_be_string'),
            'file_id.uuid' => trans('general_validate.file_id_must_be_valid_uuid'),
            'file_id.exists' => trans('general_validate.file_id_not_exists'),
            'client_name.required' => trans('general_validate.client_name_is_required'),
            'client_name.string' => trans('general_validate.client_name_must_be_string'),

            'client_phone.required' => trans('general_validate.client_phone_is_required'),
            'client_phone.string' => trans('general_validate.client_phone_must_be_string'),

            'client_field.required' => trans('general_validate.client_field_is_required'),
            'client_field.string' => trans('general_validate.client_field_must_be_string'),

            'starts_at.required' => trans('general_validate.starts_at_is_required'),
            'starts_at.string' => trans('general_validate.starts_at_must_be_string'),

            'ends_at.required' => trans('general_validate.ends_at_is_required'),
            'ends_at.string' => trans('general_validate.ends_at_must_be_string'),

        ];
    }
}
