<?php

declare(strict_types=1);

namespace App\Domain\Currency\Enums;

enum CurrencyEnum: string
{
    case BRL = 'R$';
    case USD = 'US$';
    case EUR = '€';
}
