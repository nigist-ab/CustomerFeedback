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

       // return inertia('Users/Index', [
    //'users' => $query->get(),
    //'roles' => Role::pluck('name'),
    //'selectedRole' => $role,
    //]);
    return Inertia::render('Users/Index', [
        'users' => User::with('roles')->get(),
        'roles' => Role::pluck('name'), // this gives you ['Admin', 'Agent', 'Customer']
    ]);
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->assignRole($request->role);
        return back()->with('success', 'Role assigned successfully.');
    }

    public function revokeRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->removeRole($request->role);
        return back()->with('success', 'Role revoked successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
