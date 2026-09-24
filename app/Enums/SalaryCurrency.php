<?php

namespace App\Enums;

enum SalaryCurrency: string
{
    case USD = 'USD';
    case CDF = 'CDF';

    public function label(): string
    {
        return match ($this) {
            self::USD => 'Dollar Américain (USD)',
            self::CDF => 'Franc Congolais (CDF)',
        };
    }
}
