<?php

declare(strict_types=1);

namespace App\Domain\Currency\Enums;

enum CurrencyEnum: string
{
    case REAL = 'BRL';
    case DOLAR = 'USD';
    case EURO = 'EUR';
}
