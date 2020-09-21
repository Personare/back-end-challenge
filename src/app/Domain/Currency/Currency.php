<?php
namespace App\Domain\Currency;

use App\Domain\Currency\Interfaces\CurrencyInterface;

abstract class Currency implements CurrencyInterface
{
    protected const SYMBOL = '';
    protected const CODE = '';

    public function getSymbol() : string
    {
        return $this::SYMBOL;
    }

    public function getCode() : string
    {
        return $this::CODE;
    }

}
