<?php

namespace PersonareExchange\Domain\Entities;

class Exchange
{
  private $to;
  private $amount;

  public function __construct(Currency $to, float $amount)
  {
    $this->to = $to;
    $this->amount = $amount;
  }

  public function convert() : float
  {
    return $this->amount * $this->to->getValue();
  }
}