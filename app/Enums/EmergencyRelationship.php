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
            self::FATHER => 'Father',
            self::MOTHER => 'Mother',
            self::SPOUSE => 'Spouse',
            self::BROTHER => 'Brother',
            self::SISTER => 'Sister',
            self::MR => 'Mr',
            self::MRS => 'Mrs',
            self::DR => 'Dr',
        };
    }
}
