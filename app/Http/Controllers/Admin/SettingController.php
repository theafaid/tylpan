<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Settings\SiteSettingsUpdateService;
use App\Http\Requests\Admin\Settings\GeneralSettingsUpdateRequest;

class SettingController extends Controller
{
    protected $service;

    /**
     * SettingController constructor.
     * @param SiteSettingsUpdateService $service
     */
    public function __construct(SiteSettingsUpdateService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * @param GeneralSettingsUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGeneralSettings(GeneralSettingsUpdateRequest $request)
    {
        $this->service->handleUpdateGeneralSettings($request->validated());

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAdditionalSettings()
    {
        $this->service->handleUpdateAdditionalSettings(request()->all());

        return back();
    }
}
