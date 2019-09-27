<?php

namespace App\Caching;

use App\Caching\Traits\Refreshable;
use Illuminate\Support\Facades\Cache;
use App\Eloquent\Countries as BaseCountries;

class Countries
{
    use Refreshable;

    /**
     * Get allowed countries to travel from it
     * @return mixed
     */
    public function allowedTravelFrom()
    {
        return Cache::rememberForever($this->cacheKeys()[0], function () {
            return resolve(BaseCountries::class)->allowedTravelFrom();
        }) ?: [];
    }

    /**
     * Get allowed countries to travel to it
     * @return mixed
     */
    public function allowedTravelTo()
    {
        return Cache::rememberForever($this->cacheKeys()[1], function () {
            return resolve(BaseCountries::class)->allowedTravelTo();
        }) ?: [];

    }

    /**
     * Get all countries
     * @return object
     */
    public function all()
    {
        return array_values(
            array_unique(array_merge(
                (array) $this->allowedTravelTo(), (array) $this->allowedTravelFrom()
            ))
        )[0];
    }

    public function cacheKeys() {
        return [
            'allowed_travel_from_countries', 'allowed_travel_to_countries',
        ];
    }
}
