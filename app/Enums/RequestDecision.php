<?php

namespace App\Enums;

enum RequestDecision: string
{
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::APPROVED => 'Approuvé',
            self::REJECTED => 'Rejeté',
        };
    }
}
