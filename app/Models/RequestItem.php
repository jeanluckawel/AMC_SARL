<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestItem extends Model
{
    protected $fillable = [
        'request_id',
        'name',
        'quantity',
        'unit',
        'description',
        'unit_price',
        'total_price',
        'supplier',
        'supplier_reference',
        'procurement_note',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(
            RequestModel::class,
            'request_id'
        );
    }
}
