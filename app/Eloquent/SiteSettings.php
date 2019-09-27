<?php

namespace App\Eloquent;

use App\Models\AdditionalSetting;
use App\Models\GeneralSetting;
use App\Models\SiteFeature;
use App\Models\SiteFeatures;

class SiteSettings
{
    /**
     * Get site general settings
     * @return mixed
     */
    public function generalSettings()
    {
        return GeneralSetting::first();
    }

    /**
     * Get site additional settings
     * @return mixed
     */
    public function additionalSettings()
    {
        return AdditionalSetting::first();
    }

    /**
     * Get all site features
     * @return mixed
     */
    public function features()
    {
        return SiteFeature::get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function updateGeneralSettings($data)
    {
        $generalSettings = GeneralSetting::first();

        $generalSettings->update($data);

        return $generalSettings;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function updateAdditionalSettings($data)
    {
        $additionalSettings = AdditionalSetting::first();

        $additionalSettings->update(array_filter($data));

        return $additionalSettings;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function storeFeature($data)
    {
        return SiteFeature::create($data);
    }
}
