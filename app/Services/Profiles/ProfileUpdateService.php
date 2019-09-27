<?php

namespace App\Services;

use App\Eloquent\Profiles;
use App\Eloquent\Users;

/**
 * Class ProfileUpdateService
 * @package App\Services
 */
class ProfileUpdateService
{
    protected $users, $profiles;
    protected $profileColumns = ['gender', 'age', 'phone_number'];
    protected $generalColumns = ['first_name', 'middle_name', 'last_name', 'email', 'password', 'country_id'];

    /**
     * ProfileUpdateService constructor.
     * @param Users $users
     */
    public function __construct(Users $users, Profiles  $profiles)
    {
        $this->users = $users;
        $this->profiles = $profiles;
    }

    /**
     * Update user general settings
     * @param $data
     * @param null $userId
     */
    public function updateGeneralSettings($data, $userId = null)
    {
        $user = $this->getUser($userId);

        $this->users->update($user, $this->getOnlyGeneralData($data));

        $this->profiles->update($user, $this->getOnlyProfileData($data));
    }

    /**
     * Update the required education data
     * @param $data
     * @param null $userId
     */
    public function updateRequiredEducationSettings($data, $userId = null)
    {
        $user = $this->getUser($userId);

        $this->profiles->update($user, $data);
    }

    /**
     * Update user optional settings
     * @param $data
     * @param null $user
     */
    public function handleOptionalSettings($data, $userId = null)
    {
        $user = $this->getUser($userId);

        $data['certifications'] = json_encode($data['certifications']);
        $data['speaking_languages'] = json_encode($data['speaking_languages']);

        $this->profiles->update($user, $data);
    }

//    protected function getCertificateUuid($certificate)
//    {
//        if(! isset($certificate['link'])) return $certificate['uuid'];
//
//        preg_match('/https:\/\/ucarecdn.com\/(.+)\//', $certificate['link'], $match);
//
//        return $match[1];
//    }

    /**
     * Fetch only the general data for users table (from request)
     * @param $data
     * @return array
     */
    protected function getOnlyGeneralData($data)
    {
        return collect($data)->filter(function ($value, $key) {
            return in_array($key, $this->generalColumns);
        })->toArray();
    }

    /**
     * Fetch only Profile data for profiles table (from request)
     * @param $data
     * @return array
     */
    protected function getOnlyProfileData($data)
    {
        return collect($data)->filter(function ($value, $key) {
            return in_array($key, $this->profileColumns);
        })->toArray();
    }

    /**
     * Get user by id
     * @param null $userId
     * @return \Illuminate\Contracts\Auth\Authenticatable|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed|null
     */
    protected function getUser($userId = null)
    {
        if(! $userId) return auth()->user();

        return $this->users->hasAccessToOtherProfile(
            auth()->user(),
            $user = $this->users->find($userId)
        ) ? $user : response([], 403);
    }
}
