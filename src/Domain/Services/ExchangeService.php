<?php
namespace PersonareExchange\Domain\Services;

use PersonareExchange\Domain\Entities\Currency;
use PersonareExchange\Domain\Entities\Exchange;
use PersonareExchange\Infrastructure\Persistence\CurrencyRepository;

class ExchangeService
{
  private $currencyRepository;
  private $response;

  public function __construct(CurrencyRepository $currencyRepository)
  {
    $this->currencyRepository = $currencyRepository;
  }

  public function convert($from, $to, $amount) : Currency
  {
    try {
      $currencyDTO = $this->currencyRepository->findQuoteFromCode($from, $to);
      $exchange = new Exchange($currencyDTO, $amount);
      $convertedValue = $exchange->convert();
      $value = number_format($convertedValue, 3);
      $converted = new Currency();
      $converted->setCode($to);
      $converted->setValue($value);
      return $converted;
    } catch (\Throwable $ex) {
      throw new \Exception($ex->getMessage(), $ex->getCode());
    }
  }
}
