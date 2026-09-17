<?php

namespace App\Http\Requests;

use App\Constants\FileModuleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FileCreateRequest extends FormRequest
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
            'file' => ['required', 'file'],
            'type' => ['nullable', 'integer', Rule::in(array_keys(FileModuleType::TYPE_LIST))],
        ];
    }

    public function messages(): array
    {
        return [

            'file.file' => trans('general_validate.file_must_be_file')
        ];
    }
}
