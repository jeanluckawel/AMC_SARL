<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use Hasfactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country'
    ];

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}
