<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Support\Traits\Datatable\Dataviewer;

class Country extends Model
{
    use Dataviewer;

    protected $guarded = [];

    protected $casts = [
        'calling_codes' => 'array'
    ];
    public $timestamps = false;

    protected $allowedFilters = ['name', 'travel_to', 'travel_from', 'alpha2_code', 'region', 'users.count', 'delegates.count',];
    protected $orderable = ['name', 'travel_to', 'travel_from', 'alpha2_code', 'region'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return "alpha2_code";
    }

    /**
     * Fetch all users from this country
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    /**
     * Fetch all delegates in a specific country
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function delegates()
    {
        return $this->hasMany(User::class)->where(['role' => 'delegate']);
    }

    /**
     * Fetch all universities in a specific country
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universities()
    {
        return $this->hasMany(University::class);
    }
}
