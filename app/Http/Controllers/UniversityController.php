<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Eloquent\Universities;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('countries')) {
           return resolve(Universities::class)->in(explode(',', request('countries')));
        }

        return response([], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($country, University $university)
    {
        return view('universities.show', [
            'university' => $university
        ]);
    }
}
