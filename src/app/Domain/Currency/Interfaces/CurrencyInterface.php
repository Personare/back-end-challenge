<?php
namespace App\Domain\Currency\Interfaces;

interface CurrencyInterface
{
    public function getSymbol() : string;
    public function getCode() : string;
}
