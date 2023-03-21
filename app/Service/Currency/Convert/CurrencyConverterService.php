<?php

declare(strict_types=1);

namespace App\Service\Currency\Convert;

use App\Domain\Currency\CurrencyConverterInterface;
use App\Domain\Currency\Exceptions\CurrencyException;
use App\Domain\Currency\Entities\Currency;
use App\Domain\Currency\ValueObjects\CurrencyValueObject;

class CurrencyConverterService implements CurrencyConverterInterface
{
    public function convert(
        float $amount,
        Currency $sourceCurrency,
        Currency $targetCurrency,
        float $exchangeRate
    ): CurrencyValueObject {
        if ($exchangeRate <= 0) {
            throw new CurrencyException('Exchange rate must be greater than zero');
        }

        $convertedValue = $amount * $exchangeRate;

        return new CurrencyValueObject($convertedValue, $targetCurrency);
    }
}
