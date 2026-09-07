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
            self::FATHER => 'Father',
            self::MOTHER => 'Mother',
            self::SPOUSE => 'Spouse',
            self::BROTHER => 'Brother',
            self::SISTER => 'Sister',
        };
    }
}
