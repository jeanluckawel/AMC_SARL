<?php

namespace App\Services;

use App\Events\AuditLogCreated;
use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLogService
{
    /**
     * Enregistrer une action dans les audit logs.
     */
    public function log(
        string $action,
        ?string $module = null,
        ?string $description = null,
        ?Model $auditable = null,
        ?array $oldValues = null,
        ?array $newValues = null,
    ): AuditLog {
        $auditLog = AuditLog::create([
            'user_id' => Auth::id(),

            'action' => $action,

            'module' => $module,

            'description' => $description,

            'auditable_type' => $auditable?->getMorphClass(),

            'auditable_id' => $auditable?->getKey(),

            'old_values' => $oldValues,

            'new_values' => $newValues,

            'ip_address' => request()->ip(),

            'user_agent' => request()->userAgent(),

            'logged_at' => now(),
        ]);


        $auditLog->load('user');


        event(new AuditLogCreated($auditLog));

        return $auditLog;
    }
}
