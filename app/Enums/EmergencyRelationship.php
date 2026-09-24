<?php

namespace App\Enums;

enum EmergencyRelationship: string
{
    case FATHER = 'Father';
    case MOTHER = 'Mother';
    case SPOUSE = 'Spouse';
    case BROTHER = 'Brother';
    case SISTER = 'Sister';
    case MR = 'Mr';
    case MRS = 'Mrs';
    case DR = 'Dr';

    public function label(): string
    {
        return match ($this) {
            self::FATHER => 'Père',
            self::MOTHER => 'Mère',
            self::SPOUSE => 'Conjoint(e)',
            self::BROTHER => 'Frère',
            self::SISTER => 'Sœur',
            self::MR => 'M.',
            self::MRS => 'Mme',
            self::DR => 'Dr',
        };
    }
}
