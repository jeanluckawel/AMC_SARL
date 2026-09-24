<?php

namespace App\Enums;

enum EmployeeType: string
{
    case FULL_TIME = 'Full Time';
    case PART_TIME = 'Part Time';

    public function label(): string
    {
        return match ($this) {
            self::FULL_TIME => 'Temps plein',
            self::PART_TIME => 'Temps partiel',
        };
    }
}
