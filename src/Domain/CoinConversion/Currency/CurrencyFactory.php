<?php
namespace CoinConversion\Currency;

class CurrencyFactory
{
    public static function build($id)
    {
        switch (strtoupper($id)) {
            case BrlCurrency::ID:
                return new BrlCurrency();
            case UsdCurrency::ID:
                return new UsdCurrency();
            case EurCurrency::ID:
                return new EurCurrency();
        }
        throw new \InvalidArgumentException("Not found currency type '{$id}'.");
    }
}
