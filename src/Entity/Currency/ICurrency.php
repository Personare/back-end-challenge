<?php declare(strict_types = 1);

namespace App\Entity\Currency;

interface ICurrency
{
    public function getSymbol(): string;

    public function getIsoAbbreviation(): string;
}
