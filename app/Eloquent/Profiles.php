<?php

namespace App\Eloquent;

class Profiles
{
    public function get($user)
    {
        return $user->profile;
    }

    /**
     * Update profile for a specific user
     * @param $user
     * @param $data
     */
    public function update($user, $data)
    {
        $user->profile()->update($data);
    }
}
