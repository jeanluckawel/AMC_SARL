<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSalary extends Model
{
    //

    protected $fillable = [
        'employee_id',
        'base_salary',
        'category',
        'echelon',
        'currency',
    ];

    protected $casts = [
        'base_salary' => 'decimal:2',
    ];

    /**
     * Le salaire appartient à un employé.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
