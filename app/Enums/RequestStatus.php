<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING_PROCUREMENT = 'pending_procurement';
    case PENDING_FINANCE = 'pending_finance';
    case PENDING_CEO = 'pending_ceo';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
