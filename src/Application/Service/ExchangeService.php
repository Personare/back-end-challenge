<?php

namespace Personare\Exchange\Application\Service;

use Personare\Exchange\Domain\Repository\CurrencyRepositoryInterface;
use Personare\Exchange\Application\DTO\CurrencyDTO;
use Personare\Exchange\Domain\Model\Exchange;

class ExchangeService
{
    private $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function convert($from, $to, $value) : ?CurrencyDTO
    {
        $currencyFrom = $this->currencyRepository->findFromCode($from);
        $currencyTo = $this->currencyRepository->findFromCode($to);

        if (!$currencyFrom || !$currencyTo) {
            return null;
        }

        $exchange = new Exchange($currencyFrom, $currencyTo, $value);
        $convertedValue = $exchange->convert();

        $value = number_format($convertedValue, 3);

        return new CurrencyDTO($currencyTo->getSymbol(), $value);
    }
}
