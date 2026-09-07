<?php

namespace App\Enums;

enum EmployeeType: string
{
    case FULL_TIME = 'Full Time';
    case PART_TIME = 'Part Time';

    public function label(): string
    {
        return match ($this) {
            self::FULL_TIME => 'Full Time',
            self::PART_TIME => 'Part Time',
        };
    }
}
