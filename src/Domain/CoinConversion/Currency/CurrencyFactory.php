<?php
namespace CoinConversion\Currency;

class CurrencyFactory
{
    public static function build($id)
    {
        switch (strtoupper($id)) {
            case 'BRL':
                return new BrlCurrency();
            case 'USD':
                return new UsdCurrency();
            case 'EUR':
                return new EurCurrency();
        }
        throw new \InvalidArgumentException("Not found currency type '{$id}'.");
    }
}
