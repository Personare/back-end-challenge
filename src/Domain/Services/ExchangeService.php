<?php
namespace PersonareExchange\Domain\Services;

use PersonareExchange\Domain\Repositories\ICurrencyRepository;
use PersonareExchange\Domain\Entities\Exchange;

class ExchangeService
{
  private $currencyRepository;

  public function __construct(ICurrencyRepository $currencyRepository)
  {
    $this->currencyRepository = $currencyRepository;
  }

  public function convert($from, $to, $value) : ? Currency
  {
    $currencyFrom = $this->currencyRepository->findRateFromSymbol($from);
    $currencyTo = $this->currencyRepository->findRateFromSymbol($to);
    $exchange = new Exchange($currencyFrom, $value);
    $convertedValue = $exchange->convert();
    $value = number_format($convertedValue, 3);
    return new Currency($currencyTo->getSymbol(), $value);
  }
}