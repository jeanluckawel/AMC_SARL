<?php

namespace App\Enums;

enum PerPage: int
{
    case FIVE = 5;
    case TEN = 10;
    case FIFTEEN = 15;
    case TWENTY_FIVE = 25;
    case FIFTY = 50;
    case ONE_HUNDRED = 100;
    case TWO_HUNDRED = 200;

    case FIVE_HUNDRED = 500;

    case THOUSAND = 1000;

    case TEN_THOUSAND = 10000;

    case TWENTY_FIVE_THOUSAND = 25000;

    case FIVE_HUNDRED_THOUSAND = 50000;

    public static function values(): array
    {
        return array_map(
            fn (self $case) => $case->value,
            self::cases()
        );
    }
}
