<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\UserService  $userService
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            // Return the list of users using the UserService
            return $this->userService->getUsers($request);
        }

        // Fetch all roles with only 'id' and 'name' columns
        $roles = Role::select('id', 'name')->get();

        // Fetch all ecoles with only 'id' and 'name' columns
        $ecoles = Ecole::select('id', 'name')->get();

        // Return the users index view with the users, roles, and ecoles data
        return view('users.index', compact('roles', 'ecoles'));
    }

    /**
     * Create a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        return $this->userService->createUser($request);
    }

    /**
     * Update the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        return $this->userService->editUser($request,$id);
    }

    public function disableUser(Request $request){
        return $this->userService->disableUser($request);
    }
}
