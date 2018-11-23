<?php

namespace Personare\Exchange\Domain\Repository;

use Personare\Exchange\Domain\Model\Currency;

interface CurrencyRepositoryInterface
{
    public function findFromCode($code) : ?Currency;
}