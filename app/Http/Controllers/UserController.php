<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');
        $query = User::with('roles');

        if ($role) {
            $query->role($role); // uses Spatie's role scope
        }

        return Inertia::render('Users/Index', [
            'users' => User::with('roles')->get(),
            'roles' => Role::pluck('name'), // this gives you ['Admin', 'Agent', 'Customer']
        ]);
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'user' => $user->load('roles'),
            'roles' => Role::pluck('name'), // Pass available roles for selection
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'nullable|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->role) {
            $user->syncRoles([$request->role]); // Update the user's role
        }

        return back()->with('success', 'User updated successfully.');
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,agent,customer']);
        $user->assignRole($request->role);

        // Update the `role` column in the `users` table
        $user->update(['role' => $request->role]);

        return back()->with([
            'success' => 'Role assigned successfully.',
            'roles' => $user->roles, // Return updated roles
        ]);
    }

    public function revokeRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,agent,customer']);
        $user->removeRole($request->role);

        // If no roles remain, set the `role` column to 'customer' by default
        $user->update(['role' => $user->roles->first()->name ?? 'customer']);

        return back()->with([
            'success' => 'Role revoked successfully.',
            'roles' => $user->roles, // Return updated roles
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
