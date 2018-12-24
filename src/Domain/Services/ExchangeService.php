<?php
namespace PersonareExchange\Domain\Services;

use PersonareExchange\Domain\Repositories\ICurrencyRepository;
use PersonareExchange\Application\DTO\CurrencyDTO;
use PersonareExchange\Domain\Entities\Exchange;

class ExchangeService
{
  private $currencyRepository;

  public function __construct(ICurrencyRepository $currencyRepository)
  {
    $this->currencyRepository = $currencyRepository;
  }

  public function convert($from, $to, $value) : ? CurrencyDTO
  {
    $currencyFrom = $this->currencyRepository->findRateFromSymbol($from);
    $currencyTo = $this->currencyRepository->findRateFromSymbol($to);
    if (!$currencyFrom || !$currencyTo) {
      return null;
    }
    $exchange = new Exchange($currencyFrom, $currencyTo, $value);
    $convertedValue = $exchange->convert();
    $value = number_format($convertedValue, 3);
    return new CurrencyDTO($currencyTo->getSymbol(), $value);
  }
}