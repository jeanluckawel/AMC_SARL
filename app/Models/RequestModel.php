<?php

namespace App\Models;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequestModel extends Model
{

    protected $table = 'request_models';

    protected $fillable = [
        'requester_id',
        'reference',
        'title',
        'description',
        'total_amount',
        'status',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'status' => RequestStatus::class,
        'total_amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'requester_id'
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            RequestItem::class,
            'request_id'
        );
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(
            RequestAttachment::class,
            'request_id'
        );
    }

    public function steps(): HasMany
    {
        return $this->hasMany(
            RequestStep::class,
            'request_id'
        );
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
