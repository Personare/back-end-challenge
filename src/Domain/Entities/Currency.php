<?php

namespace PersonareExchange\Domain\Entities;

class Currency
{
  protected $code;
  private $symbol;
  private $value;

  public function getCode()
  {
    return $this->code;
  }

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