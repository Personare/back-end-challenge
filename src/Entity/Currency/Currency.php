<?php declare(strict_types = 1);

namespace App\Entity\Currency;

abstract class Currency implements ICurrency
{
    protected const SYMBOL = '';

    protected const ISO_ABREVIATION = '';

    public function getSimbol(): string
    {
        return $this::SYMBOL;
    }

    public function getIsoAbbreviation(): string
    {
        return $this::ISO_ABREVIATION;
    }
}
