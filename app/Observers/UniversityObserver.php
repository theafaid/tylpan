<?php

namespace App\Observers;

use App\Models\University;
use Illuminate\Support\Str;

class UniversityObserver
{
    /**
     * Handle the university "created" event.
     *
     * @param  \App\Models\University  $university
     * @return void
     */
    public function created(University $university)
    {
        $university->update(['slug' => $this->generateSlug($university)]);
    }

    /**
     * Handle the university "updated" event.
     *
     * @param  \App\Models\University  $university
     * @return void
     */
    public function updated(University $university)
    {
        $university->update(['slug' => $this->generateSlug($university)]);
    }

    /**
     * Handle the university "deleted" event.
     *
     * @param  \App\Models\University  $university
     * @return void
     */
    public function deleted(University $university)
    {
        //
    }

    /**
     * Handle the university "restored" event.
     *
     * @param  \App\Models\University  $university
     * @return void
     */
    public function restored(University $university)
    {
        //
    }

    /**
     * Handle the university "force deleted" event.
     *
     * @param  \App\Models\University  $university
     * @return void
     */
    public function forceDeleted(University $university)
    {
        //
    }

    protected function generateSlug($university)
    {
        if(University::whereSlug($slug = Str::slug($university->name))->exists()) {
            return $slug . "_" . time();
        }

        return $slug;
    }
}
