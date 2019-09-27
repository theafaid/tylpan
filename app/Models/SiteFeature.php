<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\Datatable\Dataviewer;

class SiteFeature extends Model
{
    use Dataviewer;

    protected $guarded = [];

    public $timestamps = false;

    public $allowedFilters = ['title', 'description'];
    public $orderable = ['title'];
}
