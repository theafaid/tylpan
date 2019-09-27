<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Caching\Countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countries;

    public function __construct(Countries $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = $request->travel_from ? $this->countries->allowedTravelFrom() : $this->countries->allowedTravelTo();

        return view('countries.index', [
            'title' => 'List Of Allowed Countries To Travel To It',
            'countries'   => $countries,
        ]);
    }

    /**
     * Show a country
     * @param Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Country $country)
    {
        return view('countries.show', [
            'country' => $country->load('universities')
        ]);
    }
}
