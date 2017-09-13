<?php

namespace App\Currencies;

interface CurrencyInterface
{
    public function symbol($amount);
}