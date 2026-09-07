<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobTitle extends Model
{
    //
    protected $fillable = [
        'section_id',
        'name',
        'code',
    ];

    /**
     * Un job title appartient à une section.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Un job title peut être attribué à plusieurs employés.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
