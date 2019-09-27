<?php

namespace App\Services\Admin\SiteFeatures;

use App\Caching\SiteSettings;
use App\Eloquent\SiteSettings as BaseSiteSettings;

class SiteFeatureService
{
    protected $eloquent, $cache;

    /**
     * SiteFeatureService constructor.
     * @param BaseSiteSettings $eloquent
     * @param SiteSettings $cache
     */
    public function __construct(BaseSiteSettings $eloquent, SiteSettings $cache)
    {
        $this->eloquent = $eloquent;
        $this->cache = $cache;
    }

    /**
     * @param $data
     */
    public function handleStore($data)
    {
        $this->eloquent->storeFeature($data);

        $this->cache->refresh(
            $this->cache->siteFeaturesCacheKey(), $this->eloquent->features());

        session()->flash('success', 'Feature Created Successfuly');
    }

    public function handleUpdate($feature, $data)
    {

    }

    public function handleDelete($feature, $data)
    {

    }
}
