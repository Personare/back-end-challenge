<?php

namespace App\Domain\Currency\Convert;

use App\Domain\Currency\Enums\CurrencyEnum;

class ConvertedCurrency
{
    private CurrencyEnum $currency;
    private float $value;

    public function __construct(CurrencyEnum $currency, float $value)
    {
        $this->currency = $currency;
        $this->value = $value;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->currency->value . ' ' . number_format($this->value, 2, ',', '.');
    }
}
