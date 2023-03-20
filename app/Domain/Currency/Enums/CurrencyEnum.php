<?php

declare(strict_types=1);

namespace App\Domain\Currency\Enums;

use ReflectionClass;
use App\Domain\Currency\Exceptions\CurrencyException;

enum CurrencyEnum: string
{
    case BRL = 'R$';
    case USD = 'US$';
    case EUR = '€';

    public static function fromString(string $currencyString): ?self
    {
        return match ($currencyString) {
            'BRL' => self::BRL,
            'USD' => self::USD,
            'EUR' => self::EUR,
            default => throw new CurrencyException(
                "incorrect value. Send a value between " . implode(', ', self::listAllKeys())
            ),
        };
    }

    public static function listAllKeys(): array
    {
        $reflectionClass = new ReflectionClass(CurrencyEnum::class);
        $constants = $reflectionClass->getConstants();
        $keys = array_keys($constants);

        return $keys;
    }
}
