<?php

namespace App\Currencies;

class Eur
{

    /**
     * @param float $amount
     * @return string
     */
    public function symbol($amount)
    {
        return '€ ' . number_format($amount, 2, ',', '.');
    }
}