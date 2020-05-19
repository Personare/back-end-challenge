<?php declare(strict_types = 1);

namespace App\Entity\Currency;

interface ICurrency
{
    public function getSimbol(): string;

    public function getIsoAbbreviation(): string;
}
