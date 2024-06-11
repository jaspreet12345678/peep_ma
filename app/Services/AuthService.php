<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function login($request){
         // Validate the incoming request data
         $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Get the admin role ID from the configuration
        $adminRoleId = config('services.role.admin_role_id');

        // Extract email and password from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt($credentials)) {
            // If authentication is successful, get the authenticated user
            $authUser = Auth::user();

            // Check if the authenticated user is active
            if ($authUser->active != 1) {
                // If the user is not active, log out and redirect back with an error message
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }

            // Get the admin role ID from the configuration
            $adminRoleId = config('services.role.admin_role_id');

            // Initialize the 'is_admin' session variable to 0 (not an admin)
            Session::put('is_admin', 0);

            // Check if the authenticated user's role ID matches the admin role ID
            if ($authUser->role_id == $adminRoleId) {
                // If the user is an admin, set the 'is_admin' session variable to 1
                Session::put('is_admin', 1);
            }

            // Redirect the user to the dashboard with a success message
            return redirect()->route('dashboard');
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid credentials, please try again.');
    }

    public function logout(){
        // Log out the authenticated user
        Auth::logout();

        // Clear all session data
        Session::flush();

        // Redirect the user to the login page
        return redirect(route('login'));
    }
}
