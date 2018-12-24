<?php

namespace PersonareExchange\Domain\Entities;

class Exchange
{
  private $from;
  private $to;
  private $amount;

  public function __construct(Currency $from, Currency $to, float $amount)
  {
    $this->from = $from;
    $this->to = $to;
    $this->amount = $amount;
  }

  public function convert() : float
  {
    return $this->amount * $this->from->getValue();
  }
}