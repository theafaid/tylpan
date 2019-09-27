<?php

namespace App\Services\Admin\Users;

use App\Eloquent\Users;
use App\Notifications\Users\UserCreated;

class UserStoreService
{
    protected $users;

    /**
     * UserStoreService constructor.
     * @param Users $users
     */
    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * @param $userData
     */
    public function handle($userData)
    {
        $user = $this->users->store($userData);

        $user->notify(new UserCreated($user));

        session()->flash('success', $user->defaultName . ' now is in our site');
    }
}
