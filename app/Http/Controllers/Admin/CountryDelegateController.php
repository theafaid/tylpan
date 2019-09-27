<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Http\Controllers\Controller;

class CountryDelegateController extends Controller
{
    /**
     * @param Country $country
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Country $country)
    {

        return $country->delegates()->get([
            'id', 'first_name', 'middle_name', 'last_name'
        ]);
    }
}
