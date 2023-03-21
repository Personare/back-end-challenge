<?php

declare(strict_types=1);

namespace App\Domain\Currency\ValueObjects;

use App\Domain\Currency\Entities\Currency;

class CurrencyValueObject
{
    private float $value;
    private Currency $currency;

    public function __construct(float $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}
