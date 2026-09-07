<?php

namespace App\Enums;

enum RequestDecision: string
{
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
