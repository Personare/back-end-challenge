<?php

namespace PersonareExchange\Domain\Entities;

class Currency
{
  private $symbol;
  private $value;

  public function getSymbol()
  {
    return $this->symbol;
  }

  public function setSymbol($symbol)
  {
    $this->symbol = $symbol;
  }

  public function getValue()
  {
    return $this->value;
  }

  public function setValue($value)
  {
    $this->value = $value;
  }
}