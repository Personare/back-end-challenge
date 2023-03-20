<?php

declare(strict_types=1);

namespace App\Domain\Currency\Convert;

use App\Domain\Currency\Enums\CurrencyEnum;

class ConvertCurrency
{
    public function __construct(
        private CurrencyEnum $fromCurrency,
        private CurrencyEnum $toCurrency,
        private float $exchangeRate
    ) {
    }

    public function convert(float $value): ?float
    {
        if ($this->fromCurrency->value === 'BRL' && $this->toCurrency->value === 'USD') {
            return round($value / $this->exchangeRate, 2);
        }

        return null;
    }
}
