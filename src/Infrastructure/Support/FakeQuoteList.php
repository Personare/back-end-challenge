<?php
namespace PersonareExchange\Infrastructure\Support;

class FakeQuoteList
{
  public function list()
  {
    return array(
      'USD' => array(
        'BRL' => 3.880,
        'EUR' => 0.870,
      ),
      'EUR' => array(
        'BRL' => 4.450,
        'USD' => 1.150,
      ),
      'BRL' => array(
        'USD' => 0.260,
        'EUR' => 0.230,
      ),
    );
  }
}