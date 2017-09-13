<?php

namespace App\Currencies;

class Brl
{

    /**
     * @param float $amount
     * @return string
     */
    public function symbol($amount)
    {
        return 'R$ ' . number_format($amount, 2, ',', '.');
    }
}