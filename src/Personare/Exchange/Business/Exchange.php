<?php

namespace Personare\Exchange\Business;

class Exchange
{
    protected $currencyFrom;
    protected $currencyTo;
    protected $currencyDao;

    public function __construct($currencyDao)
    {
        $this->currencyDao = $currencyDao;
    }

    public function from($from)
    {
        $this->currencyFrom = $this->currencyDao->loadFromCode($from);

        return $this;
    }

    public function to($to)
    {
        $this->currencyTo = $this->currencyDao->loadFromCode($to);

        return $this;
    }

    public function convertValue($value)
    {
        $fromValue = $this->currencyFrom->getValue();
        $toValue = $this->currencyTo->getValue();

        if ($this->currencyTo->getBase() == true) {
            $converted = $value * $fromValue;
        } else {
            $converted = $value / $toValue;
        }

        $value = number_format($converted, 3);

        $currencyDto = new CurrencyDTO($this->currencyTo->getSymbol(), $value);

        return $currencyDto;
    }
}
