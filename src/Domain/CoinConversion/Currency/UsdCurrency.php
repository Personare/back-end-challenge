<?php
namespace CoinConversion\Currency;

class UsdCurrency implements Currency
{
    /**
     * @return string
     */
    public function getId()
    {
        return 'USD';
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return '$';
    }
}
