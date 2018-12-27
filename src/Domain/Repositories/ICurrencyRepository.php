<?php

namespace PersonareExchange\Domain\Repositories;

interface ICurrencyRepository
{
  public function findQuoteFromCode($codeFrom, $codeTo);
}