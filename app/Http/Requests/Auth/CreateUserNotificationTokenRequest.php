<?php

namespace App\Http\Requests\Auth;

use App\Constants\HasLookupType\NotificationTokenType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserNotificationTokenRequest extends FormRequest
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

            "notification_token" => ["required", "string", "unique:user_notification_tokens,notification_token", "max:255"],

            "type_id" => ["nullable", "uuid", "string", "exists:system_lookups,id"],
        ];
    }

    public function messages(): array
    {
        return [
            'notification_token.required' => trans('general_validate.notification_token_is_required'),

            'notification_token.string' => trans('general_validate.notification_token_must_be_string'),

            'notification_token.unique' => trans('general_validate.notification_token_already_exists'),


            'type_id.string' => trans('general_validate.type_id_must_be_string'),

            'type_id.exists' => trans('general_validate.type_id_not_exists'),
        ];
    }
}
