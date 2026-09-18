<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentBudget extends Model
{
    protected $fillable = [
        'department_id',
        'amount',
        'used_amount',
        'end_date',
    ];


    protected $casts = [
        'amount' => 'decimal:2',
        'used_amount' => 'decimal:2',
        'end_date' => 'date',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            Department::class,
            'department_id'
        );
    }

    public function getAvailableAmountAttribute(): float
    {
        return max(
            0,
            (float) $this->amount -
            (float) $this->used_amount
        );
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->end_date->isPast();
    }
}
