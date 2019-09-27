<?php

namespace App\Services\Admin\Settings;

use App\Caching\SiteSettings;
use App\Eloquent\SiteSettings as BaseSiteSettings;

class SiteSettingsUpdateService
{
    protected $eloquent, $cache;

    /**
     * SiteSettingsUpdateService constructor.
     * @param BaseSiteSettings $eloquent
     * @param SiteSettings $cache
     */
    public function __construct(BaseSiteSettings $eloquent, SiteSettings $cache)
    {
        $this->eloquent = $eloquent;
        $this->cache = $cache;
    }

    /**
     * Handle update general settings request
     * @param $data
     */
    public function handleUpdateGeneralSettings($data)
    {
        $generalSettings = $this->eloquent->updateGeneralSettings($data);

        $this->cache->refresh($this->cache->generalSettingsCacheKey(), $generalSettings);

        session()->flash('success', 'General Settings Updated Successfully');
    }

    /**
     * Handle updates site additional settings request
     * @param $data
     */
    public function handleUpdateAdditionalSettings($data)
    {
        $additionalSettings = $this->eloquent->updateAdditionalSettings($data);

        $this->cache->refresh($this->cache->additionalSettingCachekey(), $additionalSettings);

        session()->flash('success', 'Additional Settings updated successfully');
    }
}
