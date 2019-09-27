<?php

namespace App\Services\Profiles;

use App\Caching\Countries;
use App\Eloquent\Users;
use App\Models\Order;

class ProfileIndexService
{
    protected $countries, $users;

    /**
     * ProfileIndexService constructor.
     * @param Countries $countries
     */
    public function __construct(Countries $countries, Users $users)
    {
        $this->countries = $countries;
        $this->users = $users;
    }

    /**
     * Handle returned data
     * @param $user
     * @return array
     */
    public function handle($profileUserId)
    {
        $user = $this->getUser($profileUserId);

        $user = $user->load($this->relations());

        $countries = $this->countries->allowedTravelFrom();

        $user['country'] = $countries->where('id', $user->country_id)->first();

        return compact('user','countries');
    }

    /**
     * Determine if authentication user can access passed profile
     * @param $userId
     * @return bool
     */
    protected function hasAccessToOtherProfile($userId)
    {
        return auth()->user()->isSuperAdmin() || $this->isDelegateForAnyProfileOwnerOrders($userId);
    }

    /**
     * Check if the authenticated user is a delegate for any order that the passed user id has created
     * @param $userId
     * @return bool
     */
    protected function isDelegateForAnyProfileOwnerOrders($userId)
    {
        return auth()->user()->isDelegate() && Order::where('user_id', $userId)->where('delegate_id', auth()->id())->exists();
    }

    /**
     * Get user by id
     * @param null $userId
     * @return \Illuminate\Contracts\Auth\Authenticatable|mixed|void|null
     */
    protected function getUser($userId = null)
    {
        if(! $userId) return auth()->user();


        return $this->users->hasAccessToOtherProfile(
            auth()->user(),
            $user = $this->users->find($userId)
        ) ? $user : abort(403);
    }
    /**
     * @return array
     */
    public function relations()
    {
        return [
            'profile',
//            'country',
        ];
    }
}
