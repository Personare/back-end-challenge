<?php

namespace Personare\Exchange\Business;

class CurrencyDTO
{
    protected $symbol;
    protected $value;

    public function __construct($symbol = null, $value = null)
    {
        $this->symbol = $symbol;
        $this->value = $value;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
