<?php

namespace App\Events;

use App\Models\AuditLog;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuditLogCreated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public AuditLog $auditLog
    ) {
    }


    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('audit-logs'),
        ];
    }


    public function broadcastAs(): string
    {
        return 'audit.log.created';
    }


    public function broadcastWith(): array
    {
        return [
            'id' => $this->auditLog->id,

            'action' => $this->auditLog->action,

            'module' => $this->auditLog->module,

            'description' => $this->auditLog->description,

            'user' => $this->auditLog->user?->name,

            'logged_at' => $this->auditLog->logged_at
                ? $this->auditLog->logged_at->format('d/m/Y H:i:s')
                : null,
        ];
    }
}
