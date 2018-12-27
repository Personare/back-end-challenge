<?php
namespace PersonareExchange\Application\DTO;

class CurrencyDTO
{
  private $code;
  private $value;

  public function __construct($code, $value)
  {
    $this->code = $code;
    $this->value = $value;
  }

  /**
   * Get the value of code
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * Set the value of code
   *
   */
  public function setCode($code)
  {
    $this->code = $code;
  }

  /**
   * Get the value of value
   */
  public function getValue()
  {
    return $this->value;
  }

  /**
   * Set the value of value
   *
   */
  public function setValue($value)
  {
    $this->value = $value;
  }
}