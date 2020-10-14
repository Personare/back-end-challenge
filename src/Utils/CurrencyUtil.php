<?php

namespace App\Utils;

class CurrencyUtil
{
    static function canConvert($whiteList, $currencyFrom, $currencyTo): bool
    {
        foreach ($whiteList as $allowed) {
            if (!isset($allowed[$currencyFrom->getCode()])) {
                continue;
            }

            if ($allowed[$currencyFrom->getCode()] === $currencyTo->getCode()) {
                return true;
            }
        }
        return false;
    }

}