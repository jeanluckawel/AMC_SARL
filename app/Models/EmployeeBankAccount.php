<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeBankAccount extends Model
{
    protected $fillable = [

        'employee_id',

        'bank_name',
        'bank_branch',

        'account_holder',
        'account_number',
        'account_type',

        'rib',
        'iban',
        'swift_code',

        'currency',

        'bank_address',
        'bank_phone',
        'notes',


    ];




    public function employee(): BelongsTo
    {
        return $this->belongsTo(
            Employee::class
        );
    }
}
