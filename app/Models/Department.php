<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    //

    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Un département possède plusieurs sections.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Un département possède plusieurs employés.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany( DepartmentBudget::class, 'department_id' );

    }

}
