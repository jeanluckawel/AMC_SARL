<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $users = User::with('roles')
            ->orderBy('name')
            ->get();

        return view('users.index', compact('users'));
    }


    public function edit(User $user)
    {
        // Tous les rôles disponibles
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        // Rôles actuellement attribués à l'utilisateur
        $userRoleIds = $user->roles
            ->pluck('id')
            ->toArray();

        return view('users.edit', compact(
            'user',
            'roles',
            'userRoleIds'
        ));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => ['nullable', 'array'],
            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
        ]);

        $roleIds = $validated['roles'] ?? [];

        // Sécurité : uniquement les rôles du guard web
        $roles = Role::whereIn('id', $roleIds)
            ->where('guard_name', 'web')
            ->get();

        // Synchronisation des rôles
        $user->syncRoles($roles);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User roles updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ROLES
    |--------------------------------------------------------------------------
    */

    public function role()
    {
        $roles = Role::with('permissions')
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $perPageValues = collect(\App\Enums\PerPage::cases())
            ->pluck('value')
            ->toArray();

        $perPageLabels = collect(\App\Enums\PerPage::cases())
            ->map(fn ($item) => $item->value)
            ->toArray();

        return view('roles.index', compact(
            'roles',
            'perPageValues',
            'perPageLabels'
        ));
    }


    /**
     * Formulaire de modification d'un rôle.
     */
    public function editRole(Role $role)
    {
        // Sécurité : uniquement le guard web
        abort_unless(
            $role->guard_name === 'web',
            404
        );

        // Toutes les permissions disponibles
        $permissions = Permission::where(
            'guard_name',
            'web'
        )
            ->orderBy('name')
            ->get();

        // Permissions actuellement attribuées au rôle
        $rolePermissionIds = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('roles.edit', compact(
            'role',
            'permissions',
            'rolePermissionIds'
        ));
    }


    /**
     * Enregistre les permissions du rôle.
     */
    public function updateRole(Request $request, Role $role)
    {
        // Sécurité : uniquement le guard web
        abort_unless(
            $role->guard_name === 'web',
            404
        );

        $validated = $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        $permissionIds = $validated['permissions'] ?? [];

        // Uniquement les permissions du guard web
        $permissions = Permission::whereIn(
            'id',
            $permissionIds
        )
            ->where('guard_name', 'web')
            ->get();

        // Synchronisation des permissions
        $role->syncPermissions($permissions);

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role permissions updated successfully.'
            );
    }
}

