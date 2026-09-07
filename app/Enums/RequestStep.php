<?php

namespace App\Enums;

enum RequestStep: string
{
    case PROCUREMENT = 'procurement';
    case FINANCE = 'finance';
    case CEO = 'ceo';
}
