<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Fetch and filter users based on the request parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function getUsers($request)
    {
        // Initialize a query builder for the User model
        $query = User::query();

        // Apply role filter if provided in the request
        if ($request->has('role') && !empty($request->role)) {
            // Filter users by role name
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        if (!empty($request->active)) {
            // Filter users by active status
            $active = $request->active == '1' ? '1' : '0';
            $query->where('active', $active);
        }

        // Return the DataTables JSON response with additional columns
        return datatables()::of($query)
            ->editColumn('active', function ($user) {
                return $user->active ? 'Active' : 'Inactive';
            })
            // Add the 'ecole' column with the school name or '-' if not set
            ->addColumn('ecole', function ($user) {
                return $user->ecole ? $user->ecole->name : '-';
            })
            ->filterColumn('ecole', function ($query, $keyword) {
                $query->whereHas('ecole', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('ecole', function ($query, $order) {
                $query->leftJoin('ecole', 'users.ecole_id', '=', 'ecole.id')
                      ->orderBy('ecole.name', $order)
                      ->select('users.*'); // Ensure only user columns are selected to avoid conflicts
            })
            // Add the 'role' column with the role name or '-' if not set
            ->addColumn('role', function ($user) {
                return $user->role ? $user->role->name : '-';
            })
            ->orderColumn('role', function ($query, $order) {
                $query->leftJoin('role', 'users.role_id', '=', 'role.id')
                      ->orderBy('role.name', $order)
                      ->select('users.*'); // Ensure only user columns are selected to avoid conflicts
            })
            ->toJson(); // Convert the result to JSON format
    }

    public function createUser($request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:role,id',
            'ecole' => 'nullable|string|exists:ecole,id',
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->ecole_id = $request->ecole ?? 0;
        $user->role_id = $request->role;
        $user->active = 1;

        // Save the user
        $user->save();

        // Redirect back to the previous page
        return response()->json(['message' => 'User created successfully']);
    }

    public function editUser($request,$id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string|exists:role,id',
            'ecole' => 'nullable|string|exists:ecole,id',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user with the validated data
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // If a password is provided, hash and update it
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Update ecole_id and role_id
        $user->ecole_id = $request->ecole ?? 0;
        $user->role_id = $request->role;

        // Update the active status
        $user->active = $request->status;

        // Save the updated user data
        $user->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'User updated successfully']);
    }

    public function disableUser($request)
    {
        // Find the user by ID
        $user = User::findOrFail($request->id);

        if($request->status ==1){
            // Update the active column to 0
            $user->active = 0;
            // Save the user
            $user->save();
            return response()->json(['message' => 'User disabled successfully']);
        }else{
            $user->active = 1;
            // Save the user
            $user->save();
            return response()->json(['message' => 'User enabled successfully']);
        }
    }
}
