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

    public function convert(float $value): ?ConvertedCurrency
    {
        if ($this->fromCurrency->name === 'BRL' && $this->toCurrency->name === 'USD') {
            $convertedValue = round($value / $this->exchangeRate, 2);

            return new ConvertedCurrency($this->toCurrency, $convertedValue);
        }

        return null;
    }
}
