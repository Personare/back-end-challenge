<?php

namespace App\Domain\Currency\Factories;

use App\Domain\Currency\Interfaces\CurrencyInterface;
use App\Domain\Currency\Real;
use App\Domain\Currency\Dollar;
use App\Domain\Currency\Euro;

use InvalidArgumentException;

class CurrencyFactory
{
    protected static array $currencies = [
        'USD' => Dollar::class,
        'BRL' => Real::class,
        'EUR' => Euro::class,
    ];

    public static function create(string $currency) : CurrencyInterface
    {
        if (!isset(self::$currencies[$currency])) {
            throw new InvalidArgumentException(
                "Sorry, currency {$currency} not supported",
            );
        }
        return new self::$currencies[$currency];
    }
}
