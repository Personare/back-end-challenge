<?php

declare(strict_types=1);

namespace App\Domain\Currency;

use App\Domain\Currency\Entities\Currency;
use App\Domain\Currency\ValueObjects\CurrencyValueObject;

interface CurrencyConverterInterface
{
    /**
     * Convert currency from source to target using the provided exchange rate.
     *
     * @param float $amount
     * @param Currency $sourceCurrency
     * @param Currency $targetCurrency
     * @param float $exchangeRate
     * @return CurrencyValueObject
     */
    public function convert(
        float $amount,
        Currency $sourceCurrency,
        Currency $targetCurrency,
        float $exchangeRate
    ): CurrencyValueObject;
}
