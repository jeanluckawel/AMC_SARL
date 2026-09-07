<?php

namespace App\Models;

use App\Enums\RequestDecision;
use App\Enums\RequestStep as RequestStepEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestStep extends Model
{
    protected $fillable = [
        'request_id',
        'user_id',
        'step',
        'decision',
        'comment',
        'processed_at',
    ];

    protected $casts = [
        'step' => RequestStepEnum::class,
        'decision' => RequestDecision::class,
        'processed_at' => 'datetime',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(
            RequestModel::class,
            'request_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
