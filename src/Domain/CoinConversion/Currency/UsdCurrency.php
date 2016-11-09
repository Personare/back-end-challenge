<?php
namespace CoinConversion\Currency;

class UsdCurrency implements Currency
{
    const ID = 'USD';

    /**
     * @return string
     */
    public function getId()
    {
        return self::ID;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return '$';
    }
}
