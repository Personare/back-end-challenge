<?php
namespace CoinConversion\Currency;

class BrlCurrency implements Currency
{
    const ID = 'BRL';

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
        return 'R$';
    }
}
