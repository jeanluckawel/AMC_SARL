<?php

namespace App\Enums;

enum PayrollMonth: int
{
    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;

    public function label(): string
    {
        return match ($this) {
            self::JANUARY => 'January',
            self::FEBRUARY => 'February',
            self::MARCH => 'March',
            self::APRIL => 'April',
            self::MAY => 'May',
            self::JUNE => 'June',
            self::JULY => 'July',
            self::AUGUST => 'August',
            self::SEPTEMBER => 'September',
            self::OCTOBER => 'October',
            self::NOVEMBER => 'November',
            self::DECEMBER => 'December',
        };
    }

    public function labelFr(): string
    {
        return match ($this) {
            self::JANUARY => 'Janvier',
            self::FEBRUARY => 'Février',
            self::MARCH => 'Mars',
            self::APRIL => 'Avril',
            self::MAY => 'Mai',
            self::JUNE => 'Juin',
            self::JULY => 'Juillet',
            self::AUGUST => 'Août',
            self::SEPTEMBER => 'Septembre',
            self::OCTOBER => 'Octobre',
            self::NOVEMBER => 'Novembre',
            self::DECEMBER => 'Décembre',
        };
    }

    public static function options(): array
    {
        return [
            self::JANUARY,
            self::FEBRUARY,
            self::MARCH,
            self::APRIL,
            self::MAY,
            self::JUNE,
            self::JULY,
            self::AUGUST,
            self::SEPTEMBER,
            self::OCTOBER,
            self::NOVEMBER,
            self::DECEMBER,
        ];
    }
}
