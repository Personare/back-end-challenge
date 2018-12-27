<?php
namespace PersonareExchange\Infrastructure\Persistence;

use PersonareExchange\Domain\Repositories\ICurrencyRepository;
use PersonareExchange\Application\DTO\CurrencyDTO;
use PersonareExchange\Infrastructure\Support\FakeQuoteList;

class CurrencyRepository implements ICurrencyRepository
{
  private $http;

  public function __construct()
  {
    $this->fakeQuoteList = new FakeQuoteList();
    $this->quoteList = $this->fakeQuoteList->list();
  }

  public function findQuoteFromCode($codeFrom, $codeTo) : CurrencyDTO
  {
    try {
      $quote = $this->quoteList[$codeFrom][$codeTo];
      $currencyDTO = new CurrencyDTO($codeFrom, $quote);
      return $currencyDTO;
    } catch (\Throwable $ex) {
      throw $ex;
    }
  }
}
