<?php

namespace PersonareExchange\Domain\Entities;

use PersonareExchange\Application\DTO\CurrencyDTO;


class Exchange
{
  private $to;
  private $amount;

  public function __construct(CurrencyDTO $to, float $amount)
  {
    $this->to = $to;
    $this->amount = $amount;
  }

  public function convert() : float
  {
    return $this->amount * $this->to->getValue();
  }
}