<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')
            ->orderBy('name')
            ->get();

        return view('users.index', compact('users'));
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
}
