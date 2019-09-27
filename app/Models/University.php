<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\Datatable\Dataviewer;

class University extends Model
{
    use Dataviewer;

    protected $guarded = [];

    protected $allowedFilters = [
        'name', 'site_url', 'image', 'country.name', 'country.alpha2_code',
    ];
    protected $orderable = [
        'name', 'site_url', 'country.name', 'country.alpha2_code'
    ];

    protected $with = ['country'];

    protected $appends = ['formattedImage'];

    protected $casts = [
        'colleges' => 'array',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return "slug";
    }

    /**
     * @return mixed|string
     */
    public function getFormattedImageAttribute()
    {
        if($this->image) return $this->image;

        return "/images/univ.png";
    }

    /**
     * Get country of this univ.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
