<?php

namespace App\Enums;

enum MaritalStatus: string
{
    case SINGLE = 'single';
    case MARRIED = 'married';
    case DIVORCED = 'divorced';
    case WIDOWED = 'widowed';

    public function label(): string
    {
        return match ($this) {
            self::SINGLE => 'Célibataire',
            self::MARRIED => 'Marié(e)',
            self::DIVORCED => 'Divorcé(e)',
            self::WIDOWED => 'Veuf / Veuve',
        };
    }
}
