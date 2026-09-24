<?php

namespace App\Enums;

enum RequestStep: string
{
    case PROCUREMENT = 'procurement';
    case FINANCE = 'finance';
    case CEO = 'ceo';

    public function label(): string
    {
        return match ($this) {
            self::PROCUREMENT => 'Achats',
            self::FINANCE => 'Finance',
            self::CEO => 'Direction',
        };
    }
}
