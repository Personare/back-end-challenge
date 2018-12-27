<?php

namespace PersonareExchange\Domain\Entities;

class Currency
{
  public $code;
  public $value;

  public function getCode()
  {
    return $this->code;
  }

  public function setCode($code)
  {
    $this->code = $code;
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