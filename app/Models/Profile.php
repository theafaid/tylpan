<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    protected $requiredColsToBeCompleted = [
        'gender', 'phone_number', 'age', 'education_level', 'education_brief',
    ];
    protected $appends = ['hasCompleted', 'formattedAvatar'];

    protected $casts = [
        'certifications' => 'array',
        'social_links' => 'array',
    ];
    /**
     * Check if user has entered all required columns
     * @return bool
     */
    public function getHasCompletedAttribute()
    {
        foreach($this->requiredColsToBeCompleted as $col) {
            if($this->$col == null) return false;
        }

        return true;
    }

    /**
     * Get default avatar according to gender
     * @return mixed|string
     */
    public function getFormattedAvatarAttribute()
    {
        if($this->avatar)
            return $this->avatar . '-/scale_crop/1024x1024/center/-/quality/best/-/progressive/yes/-/resize/200x200/';

        if($this->gender == 'male') return '/images/male-avatar.png';
        elseif ($this->gender == 'female') return '/images/female-avatar.png';
        else return '/images/default-avatar.png';
    }

    public function getSpeakingLanguagesAttribute($value) {
        return json_decode($value);
    }

    /**
     * @param $country
     * @return string
     */
    public function phoneNumber($country)
    {
        if(! $this->phone_number) return;

        return "+" . json_decode($country->calling_codes)[0] . "{$this->phone_number}";
    }
}
