<?php

namespace App\Enums;

enum WorkLocation: string
{
    case HEAD_OFFICE = 'Head Office';
    case KOLWEZI = 'Kolwezi';
    case KAMOA_COPPER = 'Kamoa copper sa';
    case REMOTE = 'Remote';

    public function label(): string
    {
        return match ($this) {
            self::HEAD_OFFICE => 'Siège Social',
            self::KOLWEZI => 'Kolwezi',
            self::KAMOA_COPPER => 'Kamoa Copper SA',
            self::REMOTE => 'Télétravail',
        };
    }
}
