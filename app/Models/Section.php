<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    //

    protected $fillable = [
        'department_id',
        'name',
        'code',
    ];

    /**
     * Une section appartient à un département.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Une section possède plusieurs job titles.
     */
    public function jobTitles(): HasMany
    {
        return $this->hasMany(JobTitle::class);
    }

    /**
     * Une section possède plusieurs employés.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
