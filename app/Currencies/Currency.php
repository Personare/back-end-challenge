<?php

namespace App\Currencies;

use App\Exceptions\InvalidCurrencyException;

class Currency
{
    public static function factory($currency)
    {
        $class = ucfirst(strtolower($currency));
        $class = "App\\Currencies\\$class";

        if (!class_exists($class)) {
            throw new InvalidCurrencyException("Currency '$currency' not supported");
        }

        return new $class;
    }
}