<?php

namespace Domain\Services\Currencies;

use Domain\ValueObject\Currency;
use Domain\Repository\CurrenciesRepository;

class GetCurrencyByIso
{
    /**
     * @var CurrenciesRepository
     */
    private $repository;

    /**
     * GetCurrencyByIso constructor.
     * @param CurrenciesRepository $repository
     */
    public function __construct(CurrenciesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $from
     * @return Currency
     */
    public function from($from): \Domain\ValueObject\Currency
    {
        $record = $this->repository->getByIso($from);

        if ($record) {
            return new Currency($record['iso'], $record['symbol']);
        }
    }
}