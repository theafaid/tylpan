<?php

namespace App\Http\Controllers\Admin;

use App\Caching\Countries;
use App\Models\Country;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function __construct(Countries $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()) {
            return response([
                'collection' => Country::filter(),
            ]);
        }

        return view('admin.countries.index');
    }


    /**
     * Display a single country details
     * @param Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Country $country)
    {
        return view('admin.countries.show', [
            'country' => $country->load('users', 'universities')
        ]);
    }

    /**
     * View edit country form
     * @param Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }


    /**
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Country $country)
    {
        $country->update([
            'travel_to' => request('travel_to'),
            'travel_from' => request('travel_from'),
        ]);

        $this->countries->forget($this->countries->cacheKeys());

        session()->flash('success', 'Country Updated Successfully');

        return redirect()->route('admin.countries.index');
    }
}
