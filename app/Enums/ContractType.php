<?php

namespace App\Enums;

enum ContractType: string
{
    case CDI = 'CDI';
    case CDD = 'CDD';
    case INTERNSHIP = 'Stage';
    case CONSULTANT = 'Consultant';

    public function label(): string
    {
        return match ($this) {
            self::CDI => 'CDI (Durée Indéterminée)',
            self::CDD => 'CDD (Durée Déterminée)',
            self::INTERNSHIP => 'Stage',
            self::CONSULTANT => 'Consultant',
        };
    }

    public function requiresEndDate(): bool
    {
        return match ($this) {
            self::CDI => false,
            self::CDD,
            self::INTERNSHIP,
            self::CONSULTANT => true,
        };
    }
}
