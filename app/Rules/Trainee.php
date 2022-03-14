<?php

namespace App\Rules;

use App\Models\AppConst;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class Trainee implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        User::with('role')->where('id', $value)->first();
        return $value->role === AppConst::ROLE_TRAINEE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not the right trainee role.';
    }
}
