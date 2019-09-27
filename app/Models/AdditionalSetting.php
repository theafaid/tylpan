<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalSetting extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getSiteIconAttribute($value)
    {
        if(! $value) return;

        return $value . '-/preview/1162x693/-/setfill/ffffff/-/format/png/-/progressive/yes/-/resize/60x60/';
    }

    public function getSiteLogoAttribute($value)
    {
        if(! $value) return;

        return $value . '/-/progressive/yes/-/resize/410x100/-/quality/best/-/progressive/yes/';
    }
}
