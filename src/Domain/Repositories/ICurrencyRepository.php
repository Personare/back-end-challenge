<?php

namespace PersonareExchange\Domain\Repositories;

interface ICurrencyRepository
{
  public function findRateFromSymbol($symbol);
}