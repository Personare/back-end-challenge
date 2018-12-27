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

    public function convert($from, $to, $value) : Currency
    {
        $currencyFrom = $this->currencyRepository->findRateFromSymbol($from);
        $currencyTo = $this->currencyRepository->findRateFromSymbol($to);
        $exchange = new Exchange($currencyFrom, $value);
        $convertedValue = $exchange->convert();
        $value = number_format($convertedValue, 3);
        $converted = new Currency();
        $converted->setSymbol($currencyTo->getSymbol());
        $converted->setValue($value);
        return $converted;
    }
}
