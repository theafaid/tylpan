<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Features\FeatureStoreRequest;
use App\Models\SiteFeature;
use App\Services\Admin\SiteFeatures\SiteFeatureService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    protected $service;

    /**
     * FeatureController constructor.
     * @param SiteFeatureService $service
     */
    public function __construct(SiteFeatureService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()) {
            return response(['collection' => SiteFeature::filter()]);
        }

        return view('admin.features.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.features.create');
    }


    /**
     * Store a new site feature
     * @param FeatureStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FeatureStoreRequest $request)
    {
       $this->service->handleStore($request->validated());

        return redirect()->route('admin.features.index');
    }

    /**
     * @param SiteFeature $feature
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(SiteFeature $feature)
    {
        $feature->delete();

        return response([], 204);
    }
}
