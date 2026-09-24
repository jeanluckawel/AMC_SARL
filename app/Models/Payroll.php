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
        'employee_id',
        'year',
        'month',
        'basic_salary',
        'housing_allowance',
        'transport_allowance',
        'meal_allowance',
        'other_allowances',
        'overtime_hours',
        'overtime_amount',
        'bonus',
        'tax',
        'social_security',
        'other_deductions',
        'gross_salary',
        'total_deductions',
        'net_salary',
        'currency',
        'payment_date',
        'payment_reference',
        'remarks',
    ];

    protected $casts = [
        'month' => PayrollMonth::class,
        'payment_date' => 'date',
        'basic_salary' => 'decimal:2',
        'housing_allowance' => 'decimal:2',
        'transport_allowance' => 'decimal:2',
        'meal_allowance' => 'decimal:2',
        'other_allowances' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
        'overtime_amount' => 'decimal:2',
        'bonus' => 'decimal:2',
        'tax' => 'decimal:2',
        'social_security' => 'decimal:2',
        'other_deductions' => 'decimal:2',
        'gross_salary' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
