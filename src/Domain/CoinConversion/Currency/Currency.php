<?php
namespace CoinConversion\Currency;

interface Currency
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getSymbol();
}
