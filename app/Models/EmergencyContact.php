<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyContact extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'relationship',
        'full_name',
        'phone',
        'address',
    ];

    /**
     * Le contact d'urgence appartient à un employé.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
