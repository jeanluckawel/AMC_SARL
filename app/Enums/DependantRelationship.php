<?php

namespace App\Enums;

enum DependantRelationship: string
{
    case FATHER = 'Father';
    case MOTHER = 'Mother';
    case SPOUSE = 'Spouse';
    case BROTHER = 'Brother';
    case SISTER = 'Sister';

    public function label(): string
    {
        return match ($this) {
            self::FATHER => 'Père',
            self::MOTHER => 'Mère',
            self::SPOUSE => 'Conjoint(e)',
            self::BROTHER => 'Frère',
            self::SISTER => 'Sœur',
        };
    }
}
