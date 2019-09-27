<?php

namespace App\Rules;

use App\Models\Country;
use Illuminate\Contracts\Validation\Rule;

class ValidCountry implements Rule
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
        return Country::where('id', $value)->where('travel_from', true)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Selected country is not allowed right now !';
    }
}
