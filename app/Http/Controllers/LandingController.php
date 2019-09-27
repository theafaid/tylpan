<?php

namespace App\Http\Controllers;

use App\Caching\SiteSettings;

class LandingController extends Controller
{
    /**
     * View site landing page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome', [
            'features' => resolve(SiteSettings::class)->features()
        ]);
    }
}
