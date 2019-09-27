<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Caching\Countries;
use App\Http\Controllers\Controller;
use App\Services\Admin\Users\UserStoreService;
use App\Http\Requests\Admin\Users\UserStoreRequest;

class UserController extends Controller
{
    protected $storeService;

    public function __construct(UserStoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * Index Users
     */
    public function index()
    {
        if(request()->expectsJson()) {
            return response(['collection' => User::filter()]);
        }

        return view('admin.users.index');
    }

    /**
     * User create page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create', [
            'countries' =>  resolve(Countries::class)->all()
        ]);
    }

    /**
     * Store a user
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $this->storeService->handle($request->validated());

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete a user
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([], 204);
    }
}
