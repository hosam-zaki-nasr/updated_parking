<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;


class ValidateUserExists implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $user = User::where('phone', $value)->orWhere('email', $value)->first();

        return !empty($user) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('general_validate.user_not_exists');
    }
}
