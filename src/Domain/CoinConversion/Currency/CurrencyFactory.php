<?php
namespace CoinConversion\Currency;

class CurrencyFactory
{
    public static function build($id)
    {
        switch ($id) {
            case 'BRL':
                return new BrlCurrency();
            case 'USD':
                return new UsdCurrency();
        }
        throw new \InvalidArgumentException("Not found currency type '{$id}'.");
    }
}
