<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }
    public function index()
    {
        // Check if the logged-in user is an admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return abort(403, 'Unauthorized action.');
        }

        $users = User::all(); // Fetch all users
        return view('admin.users', compact('users'));
    }

    // Delete a user and all their dependencies
    public function destroy(User $user)
    {
        // Delete the user and all related data (e.g., their recipes, friendships, etc.)
        $user->delete(); // This will automatically delete associated records if your foreign keys are set to cascade.

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    // Show the edit form for a specific user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user information
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'bio' => 'nullable|string',
        ]);

        // Update user details
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
