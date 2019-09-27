<?php

namespace App\Eloquent;

use App\Models\University;

class Universities
{
    /**
     * Fetch all universities in a specific countries
     * @param array $countriesIds
     * @param null $cols
     * @return mixed
     */
    public function in(array $countriesIds)
    {
       return  University::whereIn('country_id', $countriesIds)->get();
    }
}
