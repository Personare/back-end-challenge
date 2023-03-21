<?php

declare(strict_types=1);

namespace App\Domain\Currency\Entities;

use App\Domain\Currency\Enums\CurrencyEnum;

class Currency
{
    private CurrencyEnum $symbol;

    private function __construct(CurrencyEnum $symbol)
    {
        $this->symbol = $symbol;
    }

    public static function create(CurrencyEnum $symbol): self
    {
        return new self($symbol);
    }

    public function getSymbol(): string
    {
        return $this->symbol->value;
    }
}
