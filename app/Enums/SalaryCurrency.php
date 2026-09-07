<?php

namespace App\Enums;

enum SalaryCurrency: string
{
    case USD = 'USD';
    case CDF = 'CDF';

    public function label(): string
    {
        return $this->value;
    }
}
