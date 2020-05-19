<?php declare(strict_types = 1);

namespace App\Entity\Currency;

class Dollar extends Currency
{
    protected const SYMBOL = '$';

    protected const ISO_ABREVIATION = 'USD';
}
