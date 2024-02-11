<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionController extends Controller
{
    public function index($roleId)
    {
        $role = Role::findById($roleId);
        if (!$role) {
            abort(404);
        }
        $permissions = Permission::all();

        return view('roles.assign-permissions', compact('role', 'permissions'));
    }

    public function assign(Request $request, $roleId)
    {
        $role = Role::findById($roleId);
        if (!$role) {
            abort(404);
        }
        
        // $permissions = $request->input('permissions', []);
        $permissions = array_map("intval", $request->input('permissions', []));
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Les permissions ont été affectées au rôle.');
    }
}