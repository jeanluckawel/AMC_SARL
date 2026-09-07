<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Services\AuditLogService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(
        Request $request,
        AuditLogService $auditLogService
    ) {
        // 1. Validation du département
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:departments,code'],
        ]);

        // 2. Création du département
        $department = Department::create($validated);

        // 3. Création de l'Audit Log
        $auditLogService->log(
            action: 'created',
            module: 'Departments',
            description: 'Création d’un nouveau département',
            auditable: $department,
            newValues: $department->toArray(),
        );

        // 4. Retour
        return redirect()
            ->back()
            ->with('success', 'Département créé avec succès.');
    }
}
