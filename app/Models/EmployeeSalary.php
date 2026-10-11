<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSalary extends Model
{
    //

// EmployeeSalary
    protected $fillable = [
        'employee_id', 'base_salary', 'category', 'echelon', 'currency',
        'payment_methods',
        'housing_allowance', 'transport_allowance', 'meal_allowance',
        'family_allowance', 'medical_allowance',
        'other_non_taxable_allowances', 'other_taxable_allowances',
        'cnss_employee', 'syndicate_deduction', 'ier',
        'cnss_employer', 'inpp_employer', 'onem_employer',
    ];

    protected $casts = [
        'payment_methods' => 'array',
    ];



    /**
     * Le salaire appartient à un employé.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
