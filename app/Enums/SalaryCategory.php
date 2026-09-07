<?php

namespace App\Enums;

enum SalaryCategory: string
{
    case A1 = 'A1';
    case A2 = 'A2';
    case A3 = 'A3';

    case B1 = 'B1';
    case B2 = 'B2';
    case B3 = 'B3';
    case B4 = 'B4';
    case B5 = 'B5';

    case C1 = 'C1';
    case C2 = 'C2';
    case C3 = 'C3';
    case C4 = 'C4';
    case C5 = 'C5';

    case D1 = 'D1';
    case D2 = 'D2';
    case D3 = 'D3';
    case D4 = 'D4';
    case D5 = 'D5';

    case E1 = 'E1';
    case E2 = 'E2';
    case E3 = 'E3';

    public function label(): string
    {
        return $this->value;
    }

    public function echelon(): SalaryEchelon
    {
        return match ($this) {
            self::A1 => SalaryEchelon::I,
            self::A2 => SalaryEchelon::II,
            self::A3 => SalaryEchelon::III,

            self::B1 => SalaryEchelon::IV,
            self::B2 => SalaryEchelon::V,
            self::B3 => SalaryEchelon::VI,
            self::B4 => SalaryEchelon::VII,
            self::B5 => SalaryEchelon::VIII,

            self::C1 => SalaryEchelon::IX,
            self::C2 => SalaryEchelon::X,
            self::C3 => SalaryEchelon::XI,
            self::C4 => SalaryEchelon::XII,
            self::C5 => SalaryEchelon::XIII,

            self::D1 => SalaryEchelon::XIV,
            self::D2 => SalaryEchelon::XV,
            self::D3 => SalaryEchelon::XVI,
            self::D4 => SalaryEchelon::XVII,
            self::D5 => SalaryEchelon::XVIII,

            self::E1 => SalaryEchelon::XIX,
            self::E2 => SalaryEchelon::XX,
            self::E3 => SalaryEchelon::XXI,
        };
    }
}
