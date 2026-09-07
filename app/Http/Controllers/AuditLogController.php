<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{

    public function index()
    {
        $auditLogs = AuditLog::with('user')
            ->latest('logged_at')
            ->paginate(20);

        return view('audit-logs.index', compact('auditLogs'));
    }

    public function show(AuditLog $auditLog)
    {
        $auditLog->load([
            'user',
            'auditable',
        ]);

        return view('audit-logs.show', compact('auditLog'));
    }
}
