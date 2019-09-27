<?php

namespace App\Caching;

use App\Caching\Traits\Refreshable;
use Illuminate\Support\Facades\Cache;
use App\Eloquent\SiteSettings as BaseSiteSettings;

class SiteSettings
{
    use Refreshable;

    /**
     * Get site general settings form cache
     * @return mixed
     */
    public function generalSettings()
    {
        return Cache::rememberForever($this->generalSettingsCacheKey(), function () {
            return resolve(BaseSiteSettings::class)->generalSettings();
        });
    }

    /**
     * Get site additional settings from cache
     * @return mixed
     */
    public function additionalSettings()
    {
        return Cache::rememberForever($this->additionalSettingCachekey(), function () {
            return resolve(BaseSiteSettings::class)->additionalSettings();
        });
    }

    /**
     * Get site features from cache
     * @return mixed
     */
    public function features()
    {
        return Cache::rememberForever('site.features', function () {
            return resolve(BaseSiteSettings::class)->features();
        });
    }

    /**
     * @return string
     */
    public function generalSettingsCacheKey()
    {
        return 'site.general_settings';
    }

    /**
     * @return string
     */
    public function additionalSettingCachekey()
    {
        return 'site.additional_settings';
    }

    /**
     * @return string
     */
    public function siteFeaturesCacheKey()
    {
        return 'site.features';
    }
}
