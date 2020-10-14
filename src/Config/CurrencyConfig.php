<?php

namespace App\Config;

class CurrencyConfig
{
    public const AVAILABLE_CONVERSIONS = 
    [
        ['BRL' => 'USD'],
        ['BRL' => 'EUR'],
        ['USD' => 'BRL'],
        ['EUR' => 'BRL']
    ];

}