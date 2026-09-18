<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('users.index', compact('users'));
    }


    public function edit(User $user)
    {

        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();


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

        abort_unless(
            $role->guard_name === 'web',
            404
        );


        $permissions = Permission::where(
            'guard_name',
            'web'
        )
            ->orderBy('name')
            ->get();


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

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $employees = Employee::all();

        return view('users.create', compact('roles','employees'));
    }


public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'employee_id' => [
            'required',
            'exists:employees,employee_id',
        ],

        'email' => [
            'required',
            'email',
            'unique:users,email',
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
        ],

        'role' => [
            'required',
            'exists:roles,name',
        ],
    ]);

    // Récupérer l'employé existant
    $employee = Employee::where(
        'employee_id',
        $validated['employee_id']
    )->firstOrFail();

    // Vérifier que l'employé n'a pas déjà un compte utilisateur
    if ($employee->user_id !== null) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Cet employé possède déjà un compte utilisateur.'
            );
    }

    // Construire le nom du User à partir de l'employé
    $name = trim(
        $employee->first_name . ' ' . $employee->last_name
    );

    // Créer le User
    $user = User::create([
        'name' => $name,
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // Attribuer le rôle
    $user->assignRole($validated['role']);

    // Mettre à jour l'employé existant
    // user_id n'a pas besoin d'être dans $fillable
    $employee->user_id = $user->id;
    $employee->save();

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'User created successfully.'
        );
}

    public function editPassword(User $user): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('users.edit-password', compact('user'));
    }

    public function updatePassword(
        Request $request,
        User $user
    ): RedirectResponse {

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->update([
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Password updated successfully.'
            );
    }




}

