<?php
namespace CoinConversion\Currency;

class EurCurrency implements Currency
{
    /**
     * @return string
     */
    public function getId()
    {
        return 'EUR';
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return '€';
    }
}
