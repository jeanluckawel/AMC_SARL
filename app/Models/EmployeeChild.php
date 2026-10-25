<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeChild extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'employee_id', 'first_name','date_of_birth', 'middle_name', 'last_name', 'gender', 'document_type', 'document_path',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        ])));
    }




}
