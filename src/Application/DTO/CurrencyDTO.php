<?php

namespace Personare\Exchange\Application\DTO;

class CurrencyDTO
{
    public $symbol;
    public $value;

    public function __construct($symbol, $value)
    {
        $this->symbol = $symbol;
        $this->value = $value;
    }
}