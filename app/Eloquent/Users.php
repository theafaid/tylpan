<?php

namespace App\Eloquent;

use App\Models\User;

class Users
{
    /**
     * Find a user by id
     * @param $userId
     * @return mixed
     */
    public function find($userId)
    {
        return User::findOrFail($userId);
    }

    /**
     * Store a new user
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }

    /**
     * Update a user
     * @param $user
     * @param $data
     */
    public function update($user, $data)
    {
        $data['password'] = $data['password'] ? bcrypt($data['password']) : $user->password;

        $user->update($data);
    }


    /**
     * Determine if the authenticated user has the rights to view profile
     * @param $authenticatedUser
     * @param $profileOwner
     * @return bool
     */
    public function hasAccessToOtherProfile($authenticatedUser, $profileOwner)
    {
        return $authenticatedUser->isSuperAdmin() || ($authenticatedUser->isDelegate() && $this->isDelegateFor($profileOwner));
    }

    /**
     * Determine if the passed user is delegate for any of profile owner orders
     * @param $user
     * @return bool
     */
    protected function isDelegateFor($user)
    {
        return (new Orders)->isDelegateForAnyOf($user->orders, auth()->user());
    }
}
