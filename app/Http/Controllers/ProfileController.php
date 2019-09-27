<?php

namespace App\Http\Controllers;

use App\Services\ProfileUpdateService;
use App\Services\Profiles\ProfileIndexService;
use App\Http\Requests\Profiles\GeneralSettingsUpdateRequest;
use App\Http\Requests\Profiles\OptionalSettingUpdateRequest;
use App\Http\Requests\Profiles\RequiredEducationSettingsUpdateRequest;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    protected $indexService, $updateService;

    public function __construct(ProfileIndexService $indexService, ProfileUpdateService $updateService)
    {
        $this->indexService = $indexService;
        $this->updateService = $updateService;
    }

    /**
     * View user profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id = null)
    {
        return view('profiles.index', $this->indexService->handle($id));
    }

    /**
     * Update user general data
     * @param GeneralSettingsUpdateRequest $request
     * @return array
     */
    public function updateGeneralSettings($userId = null, GeneralSettingsUpdateRequest $request)
    {
         $this->updateService->updateGeneralSettings($request->validated(), $userId);

         return $this->indexService->handle($userId)['user'];
    }

    /**
     * Update user education settings data
     * @param RequiredEducationSettingsUpdateRequest $request
     * @return mixed
     */
    public function updateRequiredEducationSettings($userId = null, RequiredEducationSettingsUpdateRequest $request)
    {
        $this->updateService->updateRequiredEducationSettings($request->validated(), $userId);

        return $this->indexService->handle($userId)['user'];
    }

    /**
     * Update user optional profile settings
     * @param OptionalSettingUpdateRequest $request
     * @return mixed
     */
    public function updateOptionalSettings($userId = null, OptionalSettingUpdateRequest $request)
    {
        $this->updateService->handleOptionalSettings($request->validated(), $userId);

        return $this->indexService->handle($userId)['user'];
    }
}
