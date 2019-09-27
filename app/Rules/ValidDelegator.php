<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ValidDelegator implements Rule
{
    protected $country;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($country)
    {
        $this->country = $country;
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
        return User::where('id', $value)->where('role', 'delegate')->where('country_id', $this->country->id)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid delegator passed';
    }
}
