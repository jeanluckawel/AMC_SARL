<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeParent extends Model
{
    //

    protected $fillable = [
        'employee_id',
        'relationship',
        'full_name',
        'phone',
        'deceased',
    ];

    protected $casts = [
        'deceased' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
