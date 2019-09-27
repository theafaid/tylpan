<?php

namespace App\Caching\Traits;

use Illuminate\Support\Facades\Cache;

trait Refreshable
{
    /**
     * Refresh cache values
     * @param $key
     * @param $newValue
     */
    public function refresh($key, $newValue)
    {
        $this->forget($key);
        Cache::forever($key, $newValue);
    }

    /**
     * Forget a cache key
     * @param $key
     */
    public function forget($keys)
    {
        if(is_array($keys)) {
            collect($keys)->map(function ($key) {
                Cache::forget($key);
            });
        } else {
            Cache::forget($keys);
        }
    }
}
