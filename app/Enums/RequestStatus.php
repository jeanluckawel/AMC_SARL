<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING_PROCUREMENT = 'pending_procurement';
    case PENDING_FINANCE = 'pending_finance';
    case PENDING_CEO = 'pending_ceo';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING_PROCUREMENT => 'En attente — Achats',
            self::PENDING_FINANCE => 'En attente — Finance',
            self::PENDING_CEO => 'En attente — Direction',
            self::APPROVED => 'Approuvé',
            self::REJECTED => 'Rejeté',
        };
    }
}
