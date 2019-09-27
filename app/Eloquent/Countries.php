<?php

namespace App\Eloquent;

use App\Models\Country;

class Countries
{
    /**
     * Get allowed travel to travel from it
     * @return mixed
     */
    public function allowedTravelFrom()
    {
        return Country::where('travel_from', true)->get(['id', 'name', 'flag', 'alpha2_code', 'calling_codes']);
    }

    /**
     * Get allowed countries to travel to it
     * @return mixed
     */
    public function allowedTravelTo()
    {
        return Country::where('travel_to', true)->get(['id', 'name', 'flag', 'alpha2_code', 'calling_codes']);
    }
}
