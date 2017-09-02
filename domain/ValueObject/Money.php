<?php

namespace Domain\ValueObject;

class Money
{
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * Money constructor.
     * @param $value
     * @param Currency $currency
     */
    public function __construct($value, Currency $currency)
    {
        $this->amount = $value;
        $this->currency = $currency;
    }

    /**
     * Convert class to string
     * @return string
     */
    public function __toString()
    {
        $amount = number_format($this->amount, 2, '.', '.');

        return "{$this->currency->getSymbol()} $amount";
    }
}