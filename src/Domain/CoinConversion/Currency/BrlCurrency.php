<?php
namespace CoinConversion\Currency;

class BrlCurrency implements Currency
{
    /**
     * @return string
     */
    public function getId()
    {
        return 'BRL';
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return 'R$';
    }
}
