<?php declare(strict_types = 1);

namespace App\Entity\Currency;

abstract class Currency implements ICurrency
{
    protected const SYMBOL = '';

    protected const ISO_ABBREVIATION = '';

    public function getSymbol(): string
    {
        return $this::SYMBOL;
    }

    public function getIsoAbbreviation(): string
    {
        return $this::ISO_ABBREVIATION;
    }
}
