<?php

namespace App\Enums;

enum SalaryEchelon: string
{
    case I = 'I';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';
    case VI = 'VI';
    case VII = 'VII';
    case VIII = 'VIII';
    case IX = 'IX';
    case X = 'X';
    case XI = 'XI';
    case XII = 'XII';
    case XIII = 'XIII';
    case XIV = 'XIV';
    case XV = 'XV';
    case XVI = 'XVI';
    case XVII = 'XVII';
    case XVIII = 'XVIII';
    case XIX = 'XIX';
    case XX = 'XX';
    case XXI = 'XXI';

    public function label(): string
    {
        return $this->value;
    }
}
