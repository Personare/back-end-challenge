<?php
namespace CoinConversion\Currency;

class EurCurrency implements Currency
{
    const ID = 'EUR';

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
        return '€';
    }
}
