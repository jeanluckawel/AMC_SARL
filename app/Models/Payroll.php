<?php

namespace App\Models;

use App\Enums\PayrollMonth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id', 'year', 'month', 'days_worked', 'sick_days', 'basic_salary', 'overtime_hours', 'overtime_days', 'overtime_amount', 'bonus', 'other_taxable_allowances', 'housing_allowance', 'transport_allowance', 'meal_allowance', 'family_allowance', 'medical_allowance', 'other_non_taxable_allowances', 'gross_salary', 'social_base', 'fiscal_base', 'cnss_employee', 'ipr', 'salary_advances', 'syndicate_deduction', 'other_deductions', 'cnss_employer', 'inpp_employer', 'onem_employer', 'ier', 'total_deductions', 'net_salary', 'currency', 'exchange_rate', 'payment_date', 'payment_method', 'payment_reference', 'remarks',
    ];

    protected $casts = [
        'month' => PayrollMonth::class,
        'payment_date' => 'date',


        'days_worked' => 'decimal:1',
        'overtime_hours' => 'decimal:2',


        'basic_salary' => 'decimal:2',
        'overtime_amount' => 'decimal:2',
        'bonus' => 'decimal:2',
        'other_taxable_allowances' => 'decimal:2',


        'housing_allowance' => 'decimal:2',
        'transport_allowance' => 'decimal:2',
        'meal_allowance' => 'decimal:2',
        'family_allowance' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'other_non_taxable_allowances' => 'decimal:2',


        'gross_salary' => 'decimal:2',
        'social_base' => 'decimal:2',
        'fiscal_base' => 'decimal:2',


        'cnss_employee' => 'decimal:2',
        'ipr' => 'decimal:2',
        'salary_advances' => 'decimal:2',
        'syndicate_deduction' => 'decimal:2',
        'other_deductions' => 'decimal:2',


        'cnss_employer' => 'decimal:2',
        'inpp_employer' => 'decimal:2',
        'onem_employer' => 'decimal:2',
        'ier' => 'decimal:2',


        'total_deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
