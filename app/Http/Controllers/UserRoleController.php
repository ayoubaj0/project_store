<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Spatie\Permission\Models\Role;

// class UserRoleController extends Controller
// {
    

//         return view('user_roles.index', compact('roles', 'user', 'userRoles'));
//     }

//     public function assignRoles(Request $request, User $user)
//     {
//         $validatedData = $request->validate([
//             'roles' => 'required|array',
//             'roles.*' => 'exists:roles,id',
//         ]);

//         $roles = Role::whereIn('id', $validatedData['roles'])->get();
//         $user->syncRoles($roles);

//         return redirect()->route('users.index')->with('success', 'Les rôles de l\'utilisateur ont été modifiés avec succès.');
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('user_roles.index', compact('users'));
    }
//     public function index(User $user)
//     {
//         $users = User::all();
//         $roles = Role::all();
//         $userRoles = $user->roles;


    public function showRoles(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles;
        return view('user_roles.show_roles', compact('user', 'roles', 'userRoles'));
    }

    public function assignRoles(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $roles = Role::whereIn('id', $validatedData['roles'])->get();
        $user->syncRoles($roles);

        return redirect()->route('user.roles')->with('success', 'Les rôles de l\'utilisateur ont été modifiés avec succès.');
    }

}
