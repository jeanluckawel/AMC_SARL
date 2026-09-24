<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'employee_id',


        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'number_card',
        'country',
        'marital_status',

        'employee_work_phone',
        'employee_phone',
        'employee_email',
        'employee_address',

        'photo',

        'department_id',
        'section_id',
        'job_title_id',
        'contract_type',
        'end_contract_date',
        'work_location',
        'supervisor',
        'employee_type',

        'spouse_status',
        'spouse_full_name',
        'spouse_phone',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
        'hire_date' => 'date',
        'end_contract_date' => 'date',

        'gender' => \App\Enums\Gender::class,
        'marital_status' => \App\Enums\MaritalStatus::class,
        'contract_type' => \App\Enums\ContractType::class,
        'work_location' => \App\Enums\WorkLocation::class,
        'employee_type' => \App\Enums\EmployeeType::class,
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function parents(): HasMany
    {
        return $this->hasMany(EmployeeParent::class);
    }

    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmergencyContact::class);
    }

    public function salary(): HasOne
    {
        return $this->hasOne(EmployeeSalary::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
